<template>
         <div class="border">
             <p>Id {{ id }}</p>
             <a :href="`/catalog/category/${categoryId}/product/${id}`">
            <p>Name {{ name }}</p>
             </a>
             <p>Price {{ price }}</p>
         </div>


</template>

<script setup>
import {useRoute} from "vue-router";

const route = useRoute();
const categoryId = route.params.categoryId;

defineProps({
    id: String,
    name: String,
    price: Number,

})

</script>


<style scoped>

</style>
