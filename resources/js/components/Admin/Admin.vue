<template>
    <div class="relative">
        <h1 class="text-4xl text-center text-red-900">Admin Dashboard</h1>
        <hr>

        <div class="container mx-auto flex flex-col h-screen">
            <AddCity />
            <AddDeliveryTime />
            <DeliveryToCity :cities = "cities" :deliveries="deliveries"/>
            <ExclusionDates :cities="cities"/>
    </div>
    </div>
</template>

<script>
    import AddCity from "./AddCity";
    import AddDeliveryTime from "./AddDeliveryTime";
    import DeliveryToCity from "./DeliveryToCity";
    import ExclusionDates from "./ExclusionDates";
    export default {
        name: 'Admin',
        components: {ExclusionDates, DeliveryToCity, AddDeliveryTime, AddCity},
        data(){
            return {
                cities: [],
                deliveries: [],
            }
        },

        mounted(){
            this.getCities()
            this.getDeliveries()
        },

        methods:{
            getCities(){
                axios.get('/api/cities').then(response => {
                    this.cities = response.data
                })
            },
            getDeliveries(){
                axios.get('/api/delivery-times').then(response => {
                    this.deliveries = response.data
                })
            }
        }
    }
</script>
