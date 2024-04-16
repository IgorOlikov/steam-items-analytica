<template>
         <div class=" min-h-64 max-h-64 ">
            <div class="p-10 flex flex-row border-b-2 border-l-2 border-t-2 rounded-l-2xl">
                <div class="min-w-52 cursor-pointer hover:border-b-2">
                    <img :src="`${ image }`"/>
                </div>
                <div class=" basis-2/4">
                    <a :href="`/catalog/category/${categorySlug}/product/${slug}`">
                        <p class="hover:text-amber-400">{{ name }}</p>
                    </a>
                </div>
                <div class="">
                    <p>Цена {{ price }} .руб</p>
                    <button
                        v-if="!wishlistStore.issetWishlistItem(id)"
                        @click="wishlistStore.addWishlistItem({ id: id, name: name, price: price, image: image, quantity: 1 })"
                        class="bg-red-400">
                        Желаемое
                    </button>
                    <button
                        v-else
                        @click="wishlistStore.removeWishlistItem(id)"
                        class="bg-red-400">
                        Убрать из желаемого
                    </button>

                    <button
                        @click="cartStore.addCartItem()"
                        class="bg-lime-500">Купить</button>
                </div>
            </div>
         </div>


</template>

<script setup>
import {useRoute} from "vue-router";
import {useWishlistStore} from "@/store/WishlistStore.js";
import {useCartStore} from "@/store/CartStore.js";
import {useAuthStore} from "@/store/AuthStore.js";

const wishlistStore = useWishlistStore()
const cartStore = useCartStore()
const authStore = useAuthStore()


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
