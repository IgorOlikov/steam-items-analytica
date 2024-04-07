<template>
    <div class="bg-gray-200  min-h-24 max-h-96 min-w-64 max-w-96 top-20 absolute flex flex-col">
        <catalog-menu-list
            :catalogs="catalogs"
        />
    </div>
    <catalog-sub-menu
        v-if="showSubMenu"
        :subCategories="subCategories"

    />

</template>

<script setup>
import CatalogMenuList from "@/components/CatalogMenuList.vue";
import {onMounted, ref, provide} from "vue";
import axios from "axios";
import CatalogSubMenu from "@/components/CatalogSubMenu.vue";

const catalogs = ref([])

const showSubMenu = ref(false)

const subCategories = ref([])


provide('catalogSubMenu', {
    subCategories, showSubMenu
})


async function fetchCatalog() {
    if (catalogs.value.length === 0) {

        const { data } = await axios.get(`http://localhost/api/v1/catalog`)
        //console.log(data)
        //catalogs.value = data.map((obj) => ({
        //    ...obj
        //}));
        catalogs.value = data
    }
}

onMounted(async () => {
    await fetchCatalog()

});

</script>


<style scoped>

</style>
