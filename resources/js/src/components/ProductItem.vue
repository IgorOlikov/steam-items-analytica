<template>
         <div class=" min-h-64 max-h-64 ">
             <div class="p-10 flex flex-row border-b-2 border-l-2 border-t-2 rounded-l-2xl">
                <div class="min-w-52 cursor-pointer hover:border-b-2">
                    <img :src="`${ image }`" alt="image"/>
                </div>
                <div class=" basis-2/4">
                    <RouterLink :to="{ name: 'categoryProduct', params: { categorySlug: categorySlug, productSlug: slug }}">
                        <p class="hover:text-amber-400">{{ name }}</p>
                    </RouterLink>
                </div>
                <div class="flex flex-col gap-2 items-center ">
                    <div class="">
                        <p>Цена {{ price }} .руб</p>
                    </div>
                    <div class="">
                        <button
                            v-if="!wishlistStore.issetWishlistItem(id)"
                            @click="wishlistStore.addWishlistItem({ id: id, image: image, name: name, price: price, quantity: 1 })"
                            class="border-2 rounded-xl p-1 hover:bg-red-200">
                            Добавить в желаемое
                        </button>
                        <button
                            v-else
                            @click="wishlistStore.removeWishlistItem(id)"
                            class="border-2 rounded-xl p-1 bg-red-400 hover:bg-white">
                            Удалить из желаемого
                        </button>
                    </div>
                    <div class="">
                        <button
                            v-if="!cartStore.issetCartItem(id)"
                            @click="cartStore.addCartItem({ id: id, image: image, name: name, price: price, quantity: 1 })"
                            class="border-2 rounded-xl p-1 hover:bg-lime-200">
                            Добавить в корзину
                        </button>
                        <button
                            v-else
                            @click="cartStore.removeCartItem(id)"
                            class="border-2 rounded-xl p-1 bg-lime-500 hover:bg-white">
                            Удалить из корзины
                        </button>
                    </div>
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
