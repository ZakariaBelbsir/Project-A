<template>
    <div class="bg-red-900 h-24 flex justify-between">
        <div class="mt-4">
            <h1 class="text-3xl text-white">Project A</h1>
        </div>
        <div class="flex w-auto mt-4 mb-8" v-if="!loggedIn">
            <router-link to="/" class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Home</router-link>
            <router-link to="/about" class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">About</router-link>
            <router-link to="/register" class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Register</router-link>
            <router-link to="/login" class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Login</router-link>
        </div>
        <div class="flex w-auto mt-4 mb-8" v-if="loggedIn">
          <router-link v-if="user.role===1" to="/admin"
          class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Home
          </router-link>
          <router-link v-else to="/checkout"
          class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Home</router-link>
          <router-link to="/about" class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">About</router-link>
          <button @click="logout"  class="bg-white rounded font-bold py-2 px-4 mx-4 hover:bg-gray-200">Logout</button>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
    name: "NavBar",
        computed: {
            ...mapGetters({'loggedIn' : 'loggedIn', 'user' : 'getUser'})
        },
        methods:{
            logout(){
                this.$store.dispatch('logout')
            }
        },
    }
</script>

<style scoped>

</style>
