<script setup>

import {onMounted, ref} from "vue";
import axios from "axios";
import {useRoute} from "vue-router";
import CatalogCategoryList from "@/components/MainCatalog/CatalogCategoryList.vue";

const catalog = ref([])

const route = useRoute();
const categorySlug = route.params.categorySlug;

async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/catalog/category/${categorySlug}`)

    catalog.value = data
}


onMounted(async () => {
    await fetchCatalog()

});


</script>

<template>

    <CatalogCategoryList
        :catalog="catalog"
    />

</template>

<style scoped>

</style>
