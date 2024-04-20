<template>
    <wishlist-item
        v-for="item in wishlist"
        :key="item.id"
        :id="item.id"
        :price="item.price"
        :image="item.image"
        :quantity="item.quantity"
    />
</template>

<script setup>
import WishlistItem from "@/components/Wishlist/WishlistItem.vue";


defineProps({
    wishlist: Array,
})

</script>

<style scoped>

</style>
