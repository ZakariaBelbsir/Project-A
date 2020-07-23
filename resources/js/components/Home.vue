<template>
  <div>
    <div class="h-screen w-full bg-blue-300 home">
    <h1 class="text-5xl text-white absolute bottom-0 right-0 mr-5">Let your loved ones feel your love!
      <span><router-link to="register">Signup now!</router-link></span>
    </h1>
  </div>
  </div>
</template>

<script>
  export default {
    name: 'Home',
  }
</script>

<style scoped>
  .home{
    background-image: url("../assets/gift.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
