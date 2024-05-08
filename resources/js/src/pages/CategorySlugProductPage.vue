<template>
    <div class="h-10">

    </div>
    <div class="flex space-x-4">
       <div class="flex-col min-h-screen w-2/6 border-r-2 border-t-2 rounded-tr-2xl">
            <product-filter
                :filter="filter"
            />

            <button
                @p.prevent
                @click="fetchProducts"
                class="border-2 rounded-xl p-2 bg-orange-400 hover:bg-lime-500"
            >
                Применить фильтр
            </button>
           <button
               @p.prevent
               @click="emptyFilter"
               class="border-2 rounded-xl p-2 bg-red-300 hover:bg-red-500"
           >
               Сбросить фильтр
           </button>

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
import {onMounted, reactive, ref , provide} from "vue";
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import ProductList from "@/components/ProductList.vue";
import ProductFilter from "@/components/Filter/ProductFilter.vue";
import {useAuthStore} from "@/store/AuthStore.js";

const products = ref([])

const offset = ref(0)

const filter = ref([])

const filterParams = reactive({})

const { appDomain, apiVersion} = useAuthStore()
const route = useRoute();
const router = useRouter();
const categorySlug = route.params.categorySlug;


provide('filter', filterParams)

async function fetchProducts() {

    try {
        const {data} = await axios.get(`${appDomain}${apiVersion}/category/${categorySlug}/product`,{
        params: filterParams
        })

        products.value = data
    } catch (err) {
        console.log(err)
    }
}

async function fetchFilter() {
    try {
        const {data} = await axios.get(`${appDomain}${apiVersion}/filter/${categorySlug}`)

        filter.value = data

        data.map((obj) => {
            filterParams[obj.filter] = []
        })

    } catch (err) {
        console.log(err)
    }
}

async function emptyFilter() {

    router.go(0)
}



// sort
// offset
//category filters


onMounted(async () => {
    await fetchProducts()
    await fetchFilter()

});



</script>

<style scoped>

</style>

