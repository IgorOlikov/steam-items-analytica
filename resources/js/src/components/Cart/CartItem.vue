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
                    <div class="mt-2">
                        <button
                            @click="decrementItemQuantity(id, quantity)"
                            class="border-2 w-5 rounded-xl hover:bg-lime-200">-</button>
                        {{ quantity }}
                        <button
                            @click="incrementItemQuantity(id, quantity)"
                            class="border-2 w-5 rounded-xl hover:bg-red-500">+</button>
                    </div>
                 </div>
                <div class="basis-1/4">
                    <div class="">
                        <p>Цена:</p>
                        <p>{{ ( quantity * price ).toFixed(2) }}  .руб</p>
                    </div>
                    <div class="mt-2">
                        <button
                            @click="cartStore.removeCartItem(id)"
                            class="border-2 rounded-3xl hover:bg-red-400">
                            Удалить из корзины
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>


import {useCartStore} from "@/store/CartStore.js";
import {ref, watch} from "vue";

const props = defineProps({
    id: String,
    image: String,
    price: Number,
    quantity: Number,
    name: String,
})

const cartStore = useCartStore()

function incrementItemQuantity (id ,quantity) {

    quantity++

    cartStore.updateCartItemQuantity(id, quantity)
}

function decrementItemQuantity(id, quantity) {

    const initVal = quantity

    quantity--

    if (quantity <= 0 ) {
       const result = confirm('Вы точно хотите удалить предмет из корзины?')
        if (result) {
            cartStore.removeCartItem(id)
        } else {
            quantity++
        }
    }

    if (initVal !== quantity) {
        cartStore.updateCartItemQuantity(id, quantity)
    }
}


</script>

<style scoped>

</style>
