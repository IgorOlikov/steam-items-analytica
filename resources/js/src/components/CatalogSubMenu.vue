<template>
    <div class="bg-gray-400  min-h-24 max-h-96 min-w-64 max-w-96 top-20 left-[573px] absolute flex flex-col">
        <catalog-sub-menu-list
            :subCategories="subCategories"
        />
    </div>
</template>

<script setup>
import CatalogSubMenuList from "@/components/CatalogSubMenuList.vue";

const props = defineProps({
    subCategories: Array,
})






</script>

<style scoped>

</style>
