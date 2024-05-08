<template>


    <h1>{{ name }}</h1>
    <checkbox-list
        :checkboxlist="filters"
        :filter="filter"
    />



</template>

<script setup>

import CheckboxList from "@/components/Filter/CheckboxList.vue";

defineProps({
    name: String,
    filter: String,
    filters: Array
})

</script>


<style scoped>

</style>
