<template>

        <CatalogCategoryList
            :catalog="catalog"
        />

</template>

<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import CatalogCategoryList from "@/components/MainCatalog/CatalogCategoryList.vue";

const catalog = ref([])

async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/catalog`)

    catalog.value = data
}


onMounted(async () => {
    await fetchCatalog()

});

</script>

<style scoped>

</style>
