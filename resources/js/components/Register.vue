<template>
    <div  class="mx-auto">
        <div class="relative">
            <img src="../assets/register.jpg" width="700px" alt="" class="block mx-auto h-full">
        </div>
        <div class="w-1/3 absolute register">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="register" >
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Name
                    </label>
                    <input v-model="name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="username"
                           type="text"
                           placeholder="Username">
                </div>
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
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        Password Confirmation
                    </label>
                    <input
                        v-model="password_confirmation"
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password_confirmation"
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
    name: "Register",
    data(){
      return{
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    },
    methods:{
      register(){
        this.$store.dispatch('register', {
          'name': this.name,
          'email': this.email,
          'password': this.password,
          'password_confirmation' : this.password_confirmation
        }).then(response => {
            localStorage.setItem('user', JSON.stringify(response.data))
            if(response.data.user.role === 1){
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
    .register{
        top: 20%;
        left: 50%;
        transform: translate(-50%, 40%);
    }
</style>
