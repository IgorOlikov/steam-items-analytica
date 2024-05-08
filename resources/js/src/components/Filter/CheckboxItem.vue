<template>

    <div>
        <input @change="addFilterToQuery(filterName, value)" :type="type" :name="value" :value="value" v-model="checked">
        <label  :for="value">{{ name }}</label>
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


</script>



<style scoped>

</style>
