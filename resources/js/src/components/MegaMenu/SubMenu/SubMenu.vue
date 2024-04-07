<template>
    <div class="bg-white border-r-2 border-t-2 border-b-2 min-h-72 min-w-64 max-w-96 top-[88px] left-[608px] absolute flex flex-col rounded-tr-3xl rounded-br-3xl">
        <catalog-sub-menu-list
            :subCategories="subCategories"
        />
    </div>
</template>

<script setup>
import CatalogSubMenuList from "@/components/MegaMenu/SubMenu/SubMenuList.vue";

const props = defineProps({
    subCategories: Array,
})






</script>

<style scoped>

</style>
