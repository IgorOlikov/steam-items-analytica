<template>
    <h1>Catalog Page</h1>
    <ul>
        <li v-for="catalogItem in catalog"
            @click="$router.push(`/category/${catalogItem.id}`)"
            class="cursor-pointer"
        >
            {{ catalogItem.name }}

        </li>
    </ul>
</template>

<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

const catalog = ref([])

async function fetchCatalog() {
    const { data }  = await axios.get(`http://localhost/api/v1/catalog`)

    catalog.value = data.map((obj) => ({
        ...obj
    }));
}


onMounted(async () => {
    await fetchCatalog()

});
</script>

<style scoped>

</style>
