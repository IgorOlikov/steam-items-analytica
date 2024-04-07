<template>
    <div class="p-1">
        <catalog-sub-menu-item
            v-for="subCategory in subCategories"
            :key="subCategory.id"
            :id="subCategory.id"
            :name="subCategory.name"
            :slug="subCategory.slug"
            :parantId="subCategory.parent_id"
            :categories="subCategory.categories"
        />

    </div>
</template>

<script setup>
import CatalogSubMenuItem from "@/components/CatalogSubMenuItem.vue";

defineProps({
    subCategories: Array,
})






</script>



<style scoped>

</style>
