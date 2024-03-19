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
            v-for="catalogItem in catalog"
            :id="catalogItem.id"
            :key="catalogItem.id"
            :name="catalogItem.name"
            :categories="catalogItem.categories"

        />
    <!--v if catalog.catagories   :link -->
</template>

<style scoped>

</style>
