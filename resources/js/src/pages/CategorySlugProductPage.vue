<template>
    <div class="h-10">

    </div>
    <div class="flex space-x-4">
       <div class="flex-col min-h-screen w-2/6 border-r-2 border-t-2 rounded-tr-2xl px-5 py-5">

           <product-filter
                :filter="filter"

            />

            <button
                @p.prevent
                @click="applyFilter"
                class="border-2 rounded-xl p-2 bg-orange-400 hover:bg-lime-500 mt-4 mx-10"
            >
                Применить фильтр
            </button>
           <button
               @p.prevent
               @click="emptyFilter"
               class="border-2 rounded-xl p-2 bg-red-300 hover:bg-red-500 mx-10"
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

           <div
               v-if="productsEmpty"
               class="mt-10 mb-[1000px]   "
           >
               <p>По вашему запросу ничего не найдено. Сбросте фильтр и попробуйте снова...</p>
               <button
                   @p.prevent
                   @click="emptyFilter"
                   class="border-2 rounded-xl p-2 bg-red-300 hover:bg-red-500 mx-80 mt-10"
               >
                   Сбросить фильтр
               </button>
           </div>
                <product-list
                    :products="products"
                />
           <div ref="obs" class="mt-5 h-4 ">
           </div>
       </div>
   </div>
</template>

<script setup>
import {onMounted, reactive, ref, provide, onUnmounted, watch} from "vue";
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import ProductList from "@/components/ProductList.vue";
import ProductFilter from "@/components/Filter/ProductFilter.vue";
import {useAuthStore} from "@/store/AuthStore.js";


const productsEmpty = ref(false)

const obs = ref(null)

const selected = ref('')

const products = ref([])

const offset = ref(0)

const filter = ref([])

const filterParams = reactive({
    name: [],
    price: []
})

const { appDomain, apiVersion } = useAuthStore()
const route = useRoute();
const router = useRouter();
const categorySlug = route.params.categorySlug;

provide('filter', filterParams)
provide('offset', offset)


async function fetchProducts() {
    productsEmpty.value = false

    try {
        const {data} = await axios.get(`${appDomain}${apiVersion}/category/${categorySlug}/product`,{

        params: filterParams

        })

        if (offset.value !== 0 ) {
            products.value.push(...data)
        } else {
            products.value = data
        }

        if(products.value.length === 0) {
            productsEmpty.value = true
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

    productsEmpty.value = false
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

    if (products.value.length > 9) {
        offset.value = offset.value + 10

        filterParams['offset'] = offset.value
    } else {
        offset.value = 0

        filterParams['offset'] = offset.value
    }

    await fetchProducts()
}

const options = {
    rootMargin: '0px',
    threshold: 1.0
}

const callback = (entries, observer) => {
    if (entries[0].isIntersecting) {
        if (products.value.length !== 0) {
            loadMoreProducts()
        }
    }
}

const observer = new IntersectionObserver(callback, options);

onMounted(async () => {
    await fetchProducts()
    await fetchFilter()

    observer.observe(obs.value)
});

watch(filterParams, async () => {
    await fetchProducts()
}, { deep: true })



</script>

<style scoped>

</style>

