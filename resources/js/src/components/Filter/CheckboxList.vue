<template>




    <checkbox-item
        v-for="item in checkboxlist"
            :name="item.name"
            :type="item.type"
            :value="item.value"
            :filterName="filter"
    />



</template>

<script setup>

import CheckboxItem from "@/components/Filter/CheckboxItem.vue";

defineProps({
    checkboxlist: Array,
    filter: String
})

</script>


<style scoped>

</style>
