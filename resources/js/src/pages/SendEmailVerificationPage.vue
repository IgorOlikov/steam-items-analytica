<template>
    <h1>Отправить письмо с ссылкой на почту для подтверждения почты!</h1>
    <h1>Кнопка отправить еще!!</h1>
</template>

<script setup>

import axiosJwtApi from "@/Axios/Api.js";
import {onMounted} from "vue";

async function sendMail() {
    try {
        const response = await axiosJwtApi.post(`http://localhost/api/v1/auth/email/verify`)
        console.log(response.data)
    } catch (err) {
        console.log(err)
    }
}

onMounted(() => {
    sendMail()
})

</script>


<style scoped>

</style>
