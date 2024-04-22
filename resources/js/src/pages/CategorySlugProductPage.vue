<template>
    <div class="h-10">

    </div>
    <div class="flex space-x-4">
       <div class="flex-col min-h-screen w-2/6 border-r-2 border-t-2 rounded-tr-2xl">
            <product-filter></product-filter>
       </div>
       <div class="flex-col w-full">
           <div class="border-b-2 border-l-2 border-t-2 h-10 mb-4 rounded-l-2xl">
                <h1>sort</h1>
           </div>
           <div class="mb-10">
            <product-list
                :products="products"

            ></product-list>
           </div>
       </div>
   </div>


</template>

<script setup>
import {onMounted, reactive, ref} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";
import ProductList from "@/components/ProductList.vue";
import ProductFilter from "@/components/ProductFilter.vue";
import {useAuthStore} from "@/store/AuthStore.js";

const products = ref([])

const filter = reactive({})

const { appDomain, apiVersion} = useAuthStore()
const route = useRoute();
const categorySlug = route.params.categorySlug;

async function fetchCatalog() {

    try {
        const {data} = await axios.get(`${appDomain}${apiVersion}/category/${categorySlug}/product`,{

        })
        products.value = data
    } catch (err) {
        console.log(err)
    }
}

// sort
// offset
//category filters


onMounted(async () => {
    await fetchCatalog()

});



</script>

<style scoped>

</style>

