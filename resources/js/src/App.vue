<script setup>
import axios from "axios";
import {onMounted} from "vue";

async function fetchApi() {
    const { data }  = await axios.get(`http://localhost/api/v1/catalog`)
  console.log(data)


}

onMounted(async () => {
    await fetchApi()
;});


</script>

<template>
        <h1>APP COMPONENT</h1>
</template>

<style scoped>

</style>
