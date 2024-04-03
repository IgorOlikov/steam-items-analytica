<template>
    <h1>Profile {{ data }}</h1>
</template>

<script setup>

import {onMounted, ref} from "vue";
import axios from "axios";
import axiosJwtApi from "@/Axios/Api.js";

const data = ref([])

const fetchData = async () => {
    try {
        alert('before profile request')
        alert(localStorage.getItem('token'))
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
        alert('get cooke before profile request')
        alert(getCookie('token'))
        const response = await axiosJwtApi.get(`http://localhost/api/v1/profile`)
        console.log(response.data)
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
