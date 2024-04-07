<template>
    <div>
        <div class="hover:text-amber-300 border-b-2">
            <a :href="`/catalog/category/${slug}`">
                <h1> {{ name }} </h1>
            </a>
        </div>
        <div class="mt-2">
            <catalog-menu-sub-sub-list
                :subSubCategories="categories"
            />
        </div>
    </div>

</template>

<script setup>

import CatalogMenuSubSubList from "@/components/MegaMenu/SubMenu/SubSubMenu/SubSubMenuList.vue";
import CatalogMenuItem from "@/components/MegaMenu/MenuItem.vue";

defineProps({
    id: String,
    name: String,
    slug: String,
    parentId: {
        type: [String],
        default: null
    },
    categories: Array,
})

//const arr = (...props.categories)





//alert(props.name)




</script>

<style scoped>

</style>
