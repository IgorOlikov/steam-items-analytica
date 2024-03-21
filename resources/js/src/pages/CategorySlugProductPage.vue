<template>
  <h1>Category Slug = {{ $route.params.categorySlug }} Products Page</h1>
   <div>
       <div>
            <product-filter></product-filter>
       </div>
       <div>
            <product-list
                :products="products"

            ></product-list>
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

