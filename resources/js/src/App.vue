<template>

    <div class="bg-white w-4/5 m-auto rounded-xl shadow-xl mt-14 ">
        <Header/>


        <router-view></router-view>
        <Footer></Footer>
    </div>

</template>

<script setup>

import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
</script>


<style scoped>

</style>
