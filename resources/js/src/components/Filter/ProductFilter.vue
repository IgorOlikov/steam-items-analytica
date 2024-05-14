<template>

    <div class="border-b-2">
        <default-filter

        />

        <FilterItem
            v-for="item in filter"
            :filter="item.filter"
            :name="item.name"
            :filters="item.filters"
        />
    </div>




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
