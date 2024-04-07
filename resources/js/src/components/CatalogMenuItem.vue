<template>
    <div
        @mouseover="haveNestedCategories"

    >

        <h1> {{ name }} </h1>
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
