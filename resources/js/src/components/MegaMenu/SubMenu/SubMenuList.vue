<template>
    <div class="p-5 space-y-10">
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
import CatalogSubMenuItem from "@/components/MegaMenu/SubMenu/SubMenuItem.vue";

defineProps({
    subCategories: Array,
})






</script>



<style scoped>

</style>
