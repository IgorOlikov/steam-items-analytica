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
                @click="applyFilter"
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

               <div class="flex flex-row m-1 mr-10 pl-14">
                   <div>
                       <h1>Сортировка: </h1>
                   </div>
                   <div>
                       <select @change="selectSort($event)" v-model="selected">
                            <option disabled value="">Выбрать фильтр</option>
                            <option value="1">Сначала недорогие</option>
                            <option value="2">Сначала дорогие</option>
                            <option value="3">По имени убыванию</option>
                            <option value="4">По имени возрастанию</option>
                        </select>
                   </div>
               </div>
           </div>

           <div ref="scrollPoint" class="mb-10">
                <product-list
                    :products="products"
                />
           </div>
       </div>
   </div>
</template>

<script setup>
import {onMounted, reactive, ref, provide, onUnmounted, defineAsyncComponent} from "vue";
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import ProductList from "@/components/ProductList.vue";
import ProductFilter from "@/components/Filter/ProductFilter.vue";
import {useAuthStore} from "@/store/AuthStore.js";


const scrollPoint = ref(null)

const selected = ref('')

const products = ref([])

const offset = ref(0)

const filter = ref([])

const filterParams = reactive({})

const { appDomain, apiVersion } = useAuthStore()
const route = useRoute();
const router = useRouter();
const categorySlug = route.params.categorySlug;

provide('filter', filterParams)

async function fetchProducts() {
    try {
        const {data} = await axios.get(`${appDomain}${apiVersion}/category/${categorySlug}/product`,{

        params: filterParams

        })

        if (offset.value !== 0 ) {
            products.value.push(...data)
        } else {
            products.value = data
        }
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


async function applyFilter() {

    offset.value = 0
    filterParams['offset'] = offset.value


    await fetchProducts()
}

async function selectSort(event) {

    offset.value = 0
    filterParams['offset'] = offset.value
    filterParams['sortByName'] = ''
    filterParams['sortByPrice'] = ''

    switch (event.target.value) {

        case "1":
            filterParams['sortByPrice'] = 'asc'
            break
        case "2":
            filterParams['sortByPrice'] = 'desc'
            break
        case "3":
            filterParams['sortByName'] = 'desc'
            break
        case "4":
            filterParams['sortByName'] = 'asc'
            break
    }
    await fetchProducts()
}

async function loadMoreProducts() {
    offset.value = offset.value + 10

    filterParams['offset'] = offset.value

    await fetchProducts()
}

const handeScroll = () => {
    let element = scrollPoint.value
    if (element.getBoundingClientRect().bottom < window.innerHeight) {
        loadMoreProducts()
    }
}

onMounted(async () => {
    await fetchProducts()
    await fetchFilter()
    window.addEventListener("scroll", handeScroll)
});

onUnmounted(() => {
    window.removeEventListener("scroll", handeScroll)
})

</script>

<style scoped>

</style>

