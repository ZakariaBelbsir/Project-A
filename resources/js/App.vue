<template>
    <div class="">
        <NavBar></NavBar>
        <router-view></router-view>
    </div>
</template>
<script>
  import NavBar from "./components/NavBar";
  export default {
    components:{
      NavBar
    }
  }
</script>
<style>
  h1{
    font-family: 'Lobster', cursive;
  }
</style>
