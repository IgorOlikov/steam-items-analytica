<script setup>

import {onMounted, ref} from "vue";
import axios from "axios";
import {useRoute} from "vue-router";
import CatalogCategoryList from "@/components/MainCatalog/CatalogCategoryList.vue";

const catalog = ref([])

const route = useRoute();
const categorySlug = route.params.categorySlug;

async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/catalog/category/${categorySlug}`) //?!

    catalog.value = data.map((obj) => ({
        ...obj
    }));
}


onMounted(async () => {
    await fetchCatalog()

});


</script>

<template>
<h1>Добавить историю категорий</h1>

    <h1>Catalog ID Page</h1>
    <CatalogCategoryList
        :catalog="catalog"
    />

</template>

<style scoped>

</style>
