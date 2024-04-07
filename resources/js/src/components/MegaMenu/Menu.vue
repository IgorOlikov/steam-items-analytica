<template>
    <div class="bg-white border-t-2 border-l-2 border-b-2 min-h-24 max-h-96 min-w-64 max-w-96 top-[88px] absolute flex flex-col rounded-bl-3xl">
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
import CatalogMenuList from "@/components/MegaMenu/MenuList.vue";
import {onMounted, ref, provide} from "vue";
import axios from "axios";
import CatalogSubMenu from "@/components/MegaMenu/SubMenu/SubMenu.vue";

const catalogs = ref([])

const showSubMenu = ref(false)

const subCategories = ref([])


provide('catalogSubMenu', {
    subCategories, showSubMenu
})


async function fetchCatalog() {

    if (sessionStorage.getItem('catalog') === null) {
        try {
        const { data } = await axios.get(`http://localhost/api/v1/catalog`)

        catalogs.value = data

        const jsonCatalog = JSON.stringify(data)

        sessionStorage.setItem('catalog', jsonCatalog)

        } catch (err) {
            console.log(err)
        }
    } else {
        catalogs.value = JSON.parse(sessionStorage.getItem('catalog'))
    }
}

onMounted(async () => {
    await fetchCatalog()

});

</script>


<style scoped>

</style>
