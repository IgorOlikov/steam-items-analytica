<script setup>

import CatalogMenuSubSubItem from "@/components/MegaMenu/SubMenu/SubSubMenu/SubSubMenuItem.vue";

defineProps({
    subSubCategories: Array,
})


</script>

<template>
    <div class="space-y-1">
    <catalog-menu-sub-sub-item
        v-for="subSubCategory in subSubCategories"
        :key="subSubCategory.id"
        :id="subSubCategory.id"
        :name="subSubCategory.name"
        :slug="subSubCategory.slug"
        :parantId="subSubCategory.parent_id"
        :categories="subSubCategory.categories"
    />
    </div>
</template>

<style scoped>

</style>
