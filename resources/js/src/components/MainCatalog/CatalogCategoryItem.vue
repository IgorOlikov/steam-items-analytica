<script setup>


defineProps({
    categories: Array,
    id: String,
    name: String,
    slug: String,


})

</script>

<template>

        <div v-if="categories.length !== 0"
            class="border">
            <a :href="`/catalog/category/${slug}`">
                <p>{{ name }}</p>
            </a>
        </div>
        <div v-else
             class="border"
        >
            <a
                :href="`/catalog/category/${slug}/product`"

            >
                <p>{{ name}}</p>
            </a>
        </div>


</template>

<style scoped>

</style>
