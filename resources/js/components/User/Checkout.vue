<template>
    <div class="user">
        <div class="relative">
            <h1 class="text-4xl text-center text-white">User Checkout</h1>
            <hr>
            <div class="container mx-auto flex flex-col h-screen">
                <form @submit.prevent="checkout">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cities">
                            Cities
                        </label>
                        <select
                            @change="getProducts"
                            v-model="city"
                            id="cities"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option>Pick a city</option>
                            <option v-for="city in cities.cities" :key="city.id" :value="city.id">{{city.name}}</option>
                        </select>
                    </div>
                    <div class="mb-4 flex justify-center" v-if="products">
                        <div v-for="product in products.products" :key="product.id" class="flex flex-col w-1/4 h-1/4 mx-5">
                            <img :src="product.picture" alt="" class="h-full w-full">
                            <button
                                type="button"
                                @click="setProduct(product.id)"
                                class="rounded-lg bg-red-500 hover:bg-red-700 text-white py-4 mt-5">Gift them {{product.name}}</button>
                        </div>
                    </div>
                    <div v-if="product" >
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Select Order Date</label>
                            <input
                                type="date"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                v-model="date"
                                id="date">
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Checkout
                            </button>
                        </div>
                    </div>
                </form>
                <div v-if="deliveryTimes">
                    <h1 class="text-4xl text-center text-red-900">Available delivery times for the chosen date: </h1>
                    <div class="mb-4">
                        <select
                            multiple="true"
                            id="delivery-exclude"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option v-for="delivery in deliveryTimes.deliveries[0]" :key="delivery.id" :value="delivery.id">
                                {{delivery.delivery_at}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Checkout',
    data(){
        return {
            cities: [],
            products: [],
            product: '',
            date: '',
            city: '',
            deliveryTimes: ''
        }
    },

    created(){
        axios.get('/api/cities').then(response => {
            this.cities = response.data
        })
    },
    methods:{
        getProducts(e){
            axios.get(`/api/${e.target.value}/products`).then(response => {
                this.products = response.data
            })
        },
        setProduct(id){
            this.product = id
        },
        checkout(){
            axios.post(`/api/cities/${this.city}/delivery-dates-times`, {
                'date': this.date
            }).then(response => {
                this.deliveryTimes = response.data
            })
        }
    }
}
</script>
<style scoped>
    .user{
        background-image: url("../../assets/userCheckout.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
