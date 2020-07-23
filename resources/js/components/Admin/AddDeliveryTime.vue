<template>
    <div class="relative">
        <div class="bg-red-300 text-red-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="error">
            {{error}}
        </div>
        <div class="bg-green-300 text-green-600 w-1/4 rounded-lg absolute bottom-0 right-0 mb-5 mr-5 px-2 py-4" v-if="success">
            {{success}}
        </div>
        <h1 class="text-center text-red-600">Add Delivery Times</h1>
        <form @submit.prevent="addDeliveryTime">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="delivery_times">
                    Deilivery Times
                </label>
                <input
                    v-model="deliveryTime"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="delivery_times"
                    type="text"
                    placeholder="Delivery Time">
            </div>
            <div class="flex justify-end">
                <button
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Add Delivery Time
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AddDeliveryTime",
        data(){
            return {
                deliveryTime: '',
                success: '',
                error: ''
            }
        },
        methods:{
            addDeliveryTime(){
                axios.post('/api/delivery-times', {
                    'delivery_at': this.deliveryTime
                }).then((response) => {
                    this.success = response.data.message
                    this.deliveryTime = ''
                    this.$parent.getDeliveries()
                    setTimeout(() =>{this.success = ''}, 5000)
                }).catch(err => {
                    this.error = err.response.data.message
                    setTimeout(() =>{this.error = ''}, 5000)
                })
            },
        }
    }
</script>

<style scoped>

</style>
