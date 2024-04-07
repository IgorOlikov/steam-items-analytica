<script setup>

import CatalogCategoryItem from "@/components/CatalogCategoryItem.vue";
import {computed, ref} from "vue";

defineProps({
    catalog: Array,

});


</script>

<template>
    <h1>Catalog category list</h1>
        <catalog-category-item

            v-for="category in catalog"
            :id="category.id"
            :key="category.id"
            :name="category.name"
            :categories="category.categories"
            :slug="category.slug"

        />
    <!--v if catalog.catagories   :link -->
</template>

<style scoped>

</style>
