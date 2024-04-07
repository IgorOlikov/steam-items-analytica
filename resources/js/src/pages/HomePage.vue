<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import Header from "@/components/Header.vue";



</script>

<template>
    <div class="grid grid-cols-4 gap-5 px-24 py-20 min-h-max">

        <div class="border-2 ">
            <a href="/catalog">
                <div class="p-5">
                    <div class="h-10 ">
                        <h1>Каталог</h1>
                    </div>
                    <div>
                        <h1>Большой выбор товаров</h1>
                    </div>
                    <div>
                       <img height="1" src="http://localhost/shop/catalog.png"/>
                    </div>
                </div>
            </a>
        </div>
        <div class="border-2 bg-red-400"></div>
        <div class="border-2 "></div>
        <div class="border-2 "></div>


    </div>
</template>

<style scoped>

</style>
