<template>
    <div class="relative">
        <div class="bg-red-300 text-red-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="error">
            {{error}}
        </div>
        <div class="bg-green-300 text-green-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="success">
            {{success}}
        </div>
        <h1 class="text-center text-red-600">Choose delivery times to exclude on certain dates</h1>
        <form @submit.prevent="excludeDates">
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Select Date</label>
                <input
                    type="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    v-model="date"
                    id="date">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="city-exclude">
                    Cities
                </label>
                <select
                    @change="getCityDeliveries"
                    v-model="cityToExclude"
                    id="city-exclude"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Pick a city</option>
                    <option v-for="city in cities.cities" :key="city.id" :value="city.id">{{city.name}}</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="delivery-exclude">
                    Delivery times
                </label>
                <select
                    multiple="true"
                    v-model="deliveriesToExclude"
                    id="delivery-exclude"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option v-for="delivery in cityDeliveries" :key="delivery.id" :value="delivery.id">{{delivery.delivery_at}}</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Exclude delivery times
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ExclusionDates",
        props: ['cities'],
        data(){
            return {
                date: '',
                deliveriesToExclude: [],
                cityToExclude: '',
                cityDeliveries: null,
                success: '',
                error: ''
            }
        },
        methods:{
            getCityDeliveries(){
                axios.get(`/api/cities/${this.cityToExclude}/delivery-times`).then(response =>{
                    this.cityDeliveries = response.data.deliveryTimes
                })
            },
            excludeDates(){
                axios.post(`/api/cities/${this.cityToExclude}/exclude`, {
                    'date': this.date,
                    'delivery_times': this.deliveriesToExclude,
                }).then(response =>{
                    this.success = response.data.message
                    setTimeout(() =>{this.success = ''}, 5000)
                }).catch(err => {
                    this.error = err.response.data.message
                    setTimeout(() =>{this.error = ''}, 5000)
                })
            }
        }
    }
</script>

<style scoped>

</style>
