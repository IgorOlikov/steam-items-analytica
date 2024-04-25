<template>
    <div class="px-80 py-5">
        <div
            v-if="cartStore.cart.length > 0"
            class="flex flex-row border-2 rounded-xl">
            <div class="basis-2/4 mx-auto ">
                <h1 class="">Сумма заказа {{ cartStore.summaryPrice }} .руб</h1>
                <h1>Товаров в корзине {{ cartStore.cartCount }} .шт</h1>
            </div>
            <div class="basis-1/4 ">
                <button
                    @click="sendCheckout"
                    class="border-2 border-orange-600 rounded-xl h-full  bg-lime-200 hover:bg-lime-400">
                    Оформить
                </button>
            </div>
        </div>
        <div v-else>
            <h1>Ваша корзина пуста</h1>
        </div>
        <div class="flex flex-col gap-1 mt-4">
            <cart-item
                v-for="cartItem in cart"
                :key="cartItem.id"
                :id="cartItem.id"
                :name="cartItem.name"
                :price="cartItem.price"
                :quantity="cartItem.quantity"
                :image="cartItem.image"
            />
        </div>
    </div>
</template>

<script setup>
import CartItem from "@/components/Cart/CartItem.vue";
import {useCartStore} from "@/store/CartStore.js";
import {ref, watch} from "vue";
import axiosJwtApi from "@/Axios/Api.js";

const cartStore = useCartStore()


defineProps({
    cart: Array
})


const sendCheckout = async () => {
    try {
        const res = axiosJwtApi.post(`http://localhost/api/v1/order`);

        cartStore.cart = []
        //redirect then
    } catch (err) {
        console.log(err)
    }

}



</script>

<style scoped>

</style>
