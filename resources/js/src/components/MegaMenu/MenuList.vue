<template>
    <div class="p-5 space-y-5">
    <catalog-menu-item
        v-for="catalog in catalogs"
        :key="catalog.id"
        :id="catalog.id"
        :name="catalog.name"
        :slug="catalog.slug"
        :parantId="catalog.parent_id"
        :categories="catalog.categories"
    />
    </div>
</template>

<script setup>

import CatalogMenuItem from "@/components/MegaMenu/MenuItem.vue";

defineProps({
    catalogs: Array,
})






</script>



<style scoped>

</style>
