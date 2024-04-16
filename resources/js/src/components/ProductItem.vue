<template>
         <div class="border min-h-64 max-h-64 rounded-l-2xl">
            <div class="p-10 flex flex-row" >
                <div>
                    <img :src="`${ image }`"/>
                </div>
                <div>
                    <a :href="`/catalog/category/${categorySlug}/product/${slug}`">
                        <p>Name {{ name }}</p>
                    </a>
                </div>
                <div>
                    <p>Price {{ price }}</p>
                </div>
            </div>
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
    image: String,
})



</script>


<style scoped>

</style>
