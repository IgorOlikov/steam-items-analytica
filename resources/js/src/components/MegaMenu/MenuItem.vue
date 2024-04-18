<template>
    <div
        @mouseover="haveNestedCategories"
        class="hover:text-amber-300"
    >
        <RouterLink :to="{ name: 'catalogCategory', params: { categorySlug: slug }}">
            <h1> {{ name }} </h1>
        </RouterLink>
    </div>


</template>

<script setup>

const props = defineProps({
    id: String,
    name: String,
    slug: String,
    parentId: {
        type: [String],
        default: null,
    },
    categories: Array,
})

import {inject} from "vue";




const { subCategories, showSubMenu } = inject('catalogSubMenu')

const haveNestedCategories = async (event) => {
    if (props.categories.length > 0) {
        showSubMenu.value = true

        subCategories.value = props.categories
    } else {
        showSubMenu.value = false
    }
}

/*
@mouseleave="hideSubMenu"
const hideSubMenu = async () => {
    showSubMenu.value = false
}
*/
</script>

<style scoped>

</style>
