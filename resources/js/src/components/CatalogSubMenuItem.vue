<template>
    <div>
        <div>
            <h1> {{ name }} </h1>
            <h2>  {{ parentId }}  </h2>
        </div>
        <div >
            <catalog-menu-sub-sub-list
                :subSubCategories="categories"
            />
        </div>
    </div>

</template>

<script setup>

import CatalogMenuSubSubList from "@/components/CatalogMenuSubSubList.vue";
import CatalogMenuItem from "@/components/CatalogMenuItem.vue";

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
