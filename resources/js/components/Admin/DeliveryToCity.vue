<template>
    <div class="relative" >
        <div class="bg-red-300 text-red-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="error">
            {{error}}
        </div>
        <div class="bg-green-300 text-green-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="success">
            {{success}}
        </div>
        <h1 class="text-center text-red-600">Attach Delivery Times to a City</h1>
        <form @submit.prevent="attachDeliveryToCity">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cities">
                    Cities
                </label>
                <select
                    v-model="cityToAttach"
                    id="cities"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Pick a city</option>
                    <option v-for="city in cities.cities" :key="city.id" :value="city.id">{{city.name}}</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="deliveries">
                    Delivery times
                </label>
                <select
                    multiple="true"
                    v-model="deliveryToAttach"
                    id="deliveries"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option v-for="delivery in deliveries.deliveryTimes" :key="delivery.id" :value="delivery.id">{{delivery.delivery_at}}</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Attach delivery to city
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "DeliveryToCity",
        props: ['cities', 'deliveries'],
        data(){
            return {
                success: '',
                error: '',
                cityToAttach: [],
                deliveryToAttach: [],

            }
        },
        methods:{
            attachDeliveryToCity(){
                axios.post(`api/cities/${this.cityToAttach}/delivery-times`, {
                    'delivery_times': this.deliveryToAttach
                }).then(response => {
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
