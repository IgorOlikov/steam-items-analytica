<template>
 <h1>Взять хэш из GET PARAMS и отправить GET запрос с HASH на VERIFY HASH</h1>
</template>


<script setup>
import {useRoute} from "vue-router";
import {useAuthStore} from "@/store/AuthStore.js";
import router from "@/router/router.js";
import axiosJwtApi from "@/Axios/Api.js";
import {onMounted} from "vue";

const route = useRoute();
const authStore = useAuthStore();

const url = `${authStore.appDomain}${authStore.apiVersion}/auth/email/verify/${route.params.id}/${route.params.hash}?expires=${route.query.expires}&signature=${route.query.signature}`;


const verifyEmailRequest = async () => {
    if (!authStore.auth) {
        await router.push('/login')
    } else if (authStore.userInfo.value.email_verified) {
        await router.push('/')
    }
    try {
        const response = await axiosJwtApi.get(url)

        authStore.userInfo.value.email_verified = true
        localStorage.setItem('userInfo', JSON.stringify(authStore.userInfo.value))
        await router.push('/')
    } catch (err) {
        console.log(err)
    }
}

onMounted(() => {
    verifyEmailRequest()
})

</script>

<style scoped>

</style>
