<template>

    <div
        @click.stop="clickFilter(filterName, value)"
        class="hover:bg-gray-200 cursor-pointer">
        <input :type="type" :name="value" :value="value" v-model="checked" class="cursor-pointer">
        <label
            class="ml-2 cursor-pointer"

            :for="value">{{ name }}</label>
    </div>

</template>

<script setup>

import {inject, ref} from "vue";

const checked = ref(false)

defineProps({
    name: String,
    value: String,
    type: String,
    filterName: String
})

const filter = inject('filter')

const addFilterToQuery = async (filterName, value) => {
    if(checked.value) {
        filter[filterName].push(value)
    } else {
         const index = filter[filterName].indexOf(value)

        if (index !== -1) {
            filter[filterName].splice(index, 1);
        }
    }
}

const clickFilter = async (filterName, value) => {
    checked.value = !checked.value;

    await addFilterToQuery(filterName, value)
}


</script>



<style scoped>

</style>
