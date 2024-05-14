<template>
    <default-filter

    />

    <FilterItem
        v-for="item in filter"
        :filter="item.filter"
        :name="item.name"
        :filters="item.filters"
    />




</template>

<script setup>

import FilterItem from "@/components/Filter/FilterItem.vue";
import DefaultFilter from "@/components/Filter/DefaultFilter.vue";

defineProps({
    filter: Array
})


</script>


<style scoped>

</style>
