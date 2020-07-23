<?php

namespace App\Http\Controllers;

use App\City;
use App\DeliveryTime;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityDeliveryController extends Controller
{
    public function store(Request $request, $city_id)
    {
        $request->validate([
            'delivery_times' => 'required'
        ]);

        $city = City::find($city_id);
        foreach ($request['delivery_times'] as $delivery){
            $city->delivery_time()->attach($delivery);
        }
        return response()->json([
            'message' => 'Delivery times attached to the selected city successfully'
        ]);
    }

    public function show(City $city){
        return response()->json([
            'deliveryTimes' => $city->delivery_time
        ]);
    }

    public function exclude(Request $request, City $city)
    {
        $request->validate([
            'date' => 'required|date'
        ]);
        if ($request['delivery_times'] == null){
            $deliveries = $city->delivery_time;
            if($deliveries){
                foreach ($deliveries as $delivery_time) {
                    DB::table('excluded_dates')->insert([
                        'city_id' => $city->id,
                        'delivery_time_id' => $delivery_time->id,
                        'date' => $request['date']
                    ]);
                }
                return response()->json([
                    'message' => 'Delivery times excluded successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Please attach a delivery time to the selected city'
                ]);
            }
        } else {
            foreach ($request['delivery_times'] as $delivery_time) {
                DB::table('excluded_dates')->insert([
                    'city_id' => $city->id,
                    'delivery_time_id' => $delivery_time,
                    'date' => $request['date']
                ]);
            }
            return response()->json([
                'success' => 'Delivery times excluded successfully'
            ]);
        }
    }

    public function getExcludedTimes($city_id, Request $request)
    {
        $deliveries = [];

        $exclusions = DB::table('excluded_dates')
            ->join('cities', 'excluded_dates.city_id', '=', 'cities.id')
            ->join('delivery_times', 'delivery_times.id', '=', 'excluded_dates.delivery_time_id')
            ->where('cities.id', $city_id)
            ->where('excluded_dates.date', $request['date'])
            ->select('excluded_dates.date', 'delivery_times.delivery_at', 'delivery_times.id')
            ->get();

        $city = City::find($city_id);
        if ($exclusions->isNotEmpty()){
            foreach ($exclusions as $exclusion){
                $delivery = $city->delivery_time->where('id', '<>',  $exclusion->id);
                array_push($deliveries, $delivery);
            }
            return response()->json([
                'deliveries' => $deliveries
            ]);
        } else {
            array_push($deliveries, $city->delivery_time);
            return response()->json([
                'deliveries' => $deliveries
            ]);
        }

    }

    public function getDeliverySpan($city_id, $number_of_days)
    {
        $excludedDeliveries = [];
        $exclusions = [];
        $currentDate = Carbon::now();
        $city = City::find($city_id);
        $dates=[];
        for ($i=0; $i<($number_of_days-1); $i++) {
            $newDate = $currentDate->addDay();
            $newDate = $newDate->format('y-m-d');
            array_push($dates, $newDate);
        }
        array_push($dates, Carbon::now()->format('y-m-d'));

        foreach ($dates as $date) {
            $exclusion = DB::table('excluded_dates')
                ->join('cities', 'excluded_dates.city_id', '=', 'cities.id')
                ->join('delivery_times', 'delivery_times.id', '=', 'excluded_dates.delivery_time_id')
                ->where('cities.id', $city_id)
                ->where('excluded_dates.date', $date)
                ->select('excluded_dates.*', 'delivery_times.*')
                ->get();
//            dd($exclusion);
            array_push($exclusions, $exclusion);
        }

//        dd($exclusions);

        if (!empty($exclusions)){
            foreach ($exclusions[1] as $exclusion){
                $delivery = $city->delivery_time->where('id',  $exclusion->delivery_time_id);
                array_push($excludedDeliveries, $delivery);
            }
            return response()->json([
                'excludedDeliveries' => collect($excludedDeliveries)->toArray(),
            ]);
        }

        return response()->json([
            'message' => 'There was an error fetching te excluded delivery times for this city'
        ]);
    }
}
