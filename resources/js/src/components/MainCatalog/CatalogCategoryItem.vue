<script setup>


defineProps({
    categories: Array,
    id: String,
    name: String,
    slug: String,
    image: String,


})

</script>

<template>

        <div class="flex flex-col rounded-xl transition hover:-translate-y-2">
            <div
                v-if="categories.length !== 0"
                class="mx-auto my-auto"
            >
                <RouterLink :to="{ name: 'catalogCategory', params: { categorySlug: slug }}">
                    <img :src="`${image}`">
                </RouterLink>
            </div>
            <div
                v-else
                class="mx-auto my-auto"
            >
                <RouterLink :to="{ name: 'categoryProducts', params: { categorySlug: slug }}">
                    <img :src="`${image}`">
                </RouterLink>
            </div>
            <div class="mx-auto mt-2">
                <p>{{ name }}</p>
            </div>
        </div>


</template>

<style scoped>

</style>
