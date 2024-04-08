<script setup>

import CatalogCategoryItem from "@/components/MainCatalog/CatalogCategoryItem.vue";
import {computed, ref} from "vue";

defineProps({
    catalog: Array,

});


</script>

<template>
    <div class="flex items-center justify-center max-h-screen py-96">
        <div class="grid grid-cols-3 grid-rows-2 gap-5 min-h-96 min-w-96 border">
            <catalog-category-item

                v-for="category in catalog"
                :id="category.id"
                :key="category.id"
                :name="category.name"
                :categories="category.categories"
                :slug="category.slug"

            />
        </div>
    </div>
</template>

<style scoped>

</style>
