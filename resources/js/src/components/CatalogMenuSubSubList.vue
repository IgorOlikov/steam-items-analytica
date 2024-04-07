<script setup>

import CatalogMenuSubSubItem from "@/components/CatalogMenuSubSubItem.vue";

defineProps({
    subSubCategories: Array,
})


</script>

<template>
    <catalog-menu-sub-sub-item
        v-for="subSubCategory in subSubCategories"
        :key="subSubCategory.id"
        :id="subSubCategory.id"
        :name="subSubCategory.name"
        :slug="subSubCategory.slug"
        :parantId="subSubCategory.parent_id"
        :categories="subSubCategory.categories"
    />
</template>

<style scoped>

</style>
