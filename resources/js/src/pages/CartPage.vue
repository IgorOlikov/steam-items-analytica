<template>

    <cart-list
        :cart="cartStore.cart"
    />


</template>

<script setup>

import {useCartStore} from "@/store/CartStore.js";
import {onMounted} from "vue";
import CartList from "@/components/Cart/CartList.vue";

const cartStore = useCartStore()


onMounted(() => {
    cartStore.getCart()
})

</script>


<style scoped>

</style>
