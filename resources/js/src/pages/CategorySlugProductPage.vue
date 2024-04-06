<template>
    <div class="h-10">
        <h1>Category Slug = {{ $route.params.categorySlug }} Products Page</h1>
    </div>
    <div class="flex space-x-4">
       <div class="flex-col min-h-screen w-2/6 bg-green-300">
            <product-filter></product-filter>
       </div>
       <div class="flex-col w-full">
           <div class="border h-10 mb-4">

           </div>
           <div class="mb-4">
            <product-list
                :products="products"

            ></product-list>
           </div>
       </div>
   </div>


</template>

<script setup>
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";
import ProductList from "@/components/ProductList.vue";
import ProductFilter from "@/components/ProductFilter.vue";

const products = ref([])

const route = useRoute();
const categorySlug = route.params.categorySlug;

async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/category/${categorySlug}/product`)

    products.value = data.map((obj) => ({
        ...obj
    }));
}


onMounted(async () => {
    await fetchCatalog()

});



</script>

<style scoped>

</style>

