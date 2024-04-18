<template>
    <button @click="authStore.logout()" >Logout</button>
    <h1>Profile {{ data }}</h1>

</template>

<script setup>

import {onMounted, ref} from "vue";
import axios from "axios";
import axiosJwtApi from "@/Axios/Api.js";
import {useAuthStore} from "@/store/AuthStore.js";

const data = ref([])

const authStore = useAuthStore()


const fetchData = async () => {
    try {
        const response = await axiosJwtApi.get(`http://localhost/api/v1/profile`)
        data.value = response.data
    } catch (err) {
        console.log(err)
    }
}

onMounted(() => {
    fetchData()
})


</script>


<style scoped>

</style>
