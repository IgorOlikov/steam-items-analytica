<template>
         <div class="border">
             <p>Id {{ id }}</p>
             <a :href="`/catalog/category/${categorySlug}/product/${slug}`">
            <p>Name {{ name }}</p>
             </a>
             <p>Slug {{ slug }}</p>
             <p>Price {{ price }}</p>
         </div>


</template>

<script setup>
import {useRoute} from "vue-router";


const route = useRoute();
const categorySlug = route.params.categorySlug;

defineProps({
    id: String,
    name: String,
    price: Number,
    slug: String,
})



</script>


<style scoped>

</style>
