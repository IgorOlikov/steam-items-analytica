<template>
    <div class="border-2 rounded-xl">
        <div class="p-3">
            <div class="flex flex-row gap-5">
                <div class="basis-1/4">
                    <img  width="150" height="100" :src="image">
                </div>
                <div class="basis-2/4">
                    <div>
                        <p>{{ name }}</p>
                    </div>
                </div>
                <div class="basis-1/4">
                    <div class="">
                        <p>Цена:</p>
                        <p>{{ ( quantity * price ).toFixed(2) }}  .руб</p>
                    </div>
                    <div class="mt-2">
                        <button
                            @click="wishlistStore.removeWishlistItem(id)"
                            class="border-2 rounded-3xl hover:bg-red-400">
                            Удалить из желаемого
                        </button>
                        <button
                            v-if="cartStore.issetCartItem(id)"
                            @click="$router.push('/cart')"
                            class="border-2 rounded-3xl bg-lime-400 mt-2 p-2"
                        >
                            Уже в корзине
                        </button>
                        <button
                            v-else
                            @click="cartStore.addCartItem({ id: id, image: image, name: name, price: price, quantity: 1 })"
                            class="border-2 rounded-3xl bg-orange-400 mt-2 p-2"
                        >
                            Добавить в корзину
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {useCartStore} from "@/store/CartStore.js";
import {useWishlistStore} from "@/store/WishlistStore.js";

const cartStore = useCartStore()
const wishlistStore = useWishlistStore()


defineProps({
    id: String,
    image: String,
    price: Number,
    quantity: Number,
    name: String,
})

</script>

<style scoped>

</style>
