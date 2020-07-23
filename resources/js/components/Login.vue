<template>
    <div>
        <div class="relative">
            <img src="../assets/login.jpg" width="900px" class="block mx-auto h-full" alt="">
        </div>
        <div class="absolute login w-1/2">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full" @submit.prevent="login">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        v-model="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email"
                        type="email"
                        placeholder="Email"
                    >
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password"
                    >
                        Password
                    </label>
                    <input
                        v-model="password"
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                        placeholder="******************"
                    >
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
  export default {
    name: "Login",
    data(){
      return{
        email: '',
        password: '',
      }
    },
    methods:{
        login(){
            this.$store.dispatch('login', {
                'email' : this.email,
                'password' : this.password
            }).then(() => {
                let user = JSON.parse(localStorage.getItem('user'))
                if(user.user.role === 1){
                    this.$router.push({name: 'Admin'})
                } else {
                    this.$router.push({name: 'Checkout'})
                }
            }).catch(err => {
                console.log(err.response.data.message)
            })
        }
    }
  }
</script>

<style scoped>
    .login{
        top: 20%;
        left: 50%;
        transform: translate(-40%, 60%);
    }
</style>
