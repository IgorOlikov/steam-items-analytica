<template>
    <WishlistList
        :wishlist="wishlistStore.wishlist"
    />


</template>

<script setup>
import {onMounted} from "vue";
import WishlistList from "@/components/Wishlist/WishlistList.vue";
import {useWishlistStore} from "@/store/WishlistStore.js";

const wishlistStore = useWishlistStore()






onMounted(() => {

})

</script>

<style scoped>

</style>
