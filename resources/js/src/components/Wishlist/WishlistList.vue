<template>
    <div class="px-80 py-4">
        <div class="mx-auto px-64 mt-5">
            <button
                v-if="wishlistStore.wishlist.length !== 0"
                @click="addWishlistToCart"
                class="border-2 rounded-xl p-1 hover:bg-lime-400">Добавить В Корзину</button>
        </div>
        <div class="flex flex-col gap-1 mt-4">
            <wishlist-item
                v-for="item in wishlist"
                :key="item.id"
                :id="item.id"
                :price="item.price"
                :image="item.image"
                :quantity="item.quantity"
                :name="item.name"
            />
        </div>
    </div>
</template>

<script setup>
import WishlistItem from "@/components/Wishlist/WishlistItem.vue";
import {useCartStore} from "@/store/CartStore.js";
import {useWishlistStore} from "@/store/WishlistStore.js";
import {useRouter} from "vue-router";
import {useAuthStore} from "@/store/AuthStore.js";

const cartStore = useCartStore()
const wishlistStore = useWishlistStore()
const authStore = useAuthStore()
const router = useRouter()

defineProps({
    wishlist: Array,
})




const addWishlistToCart = async () => {
    await cartStore.getCart()

    const results = wishlistStore.wishlist.filter((obj1) => !cartStore.cart.some((obj2) => obj2.id === obj1.id));

    if (results.length !== 0) {

        cartStore.cart = cartStore.cart.concat(...results)

        localStorage.setItem('cart', JSON.stringify(cartStore.cart))

        localStorage.removeItem('wishList')
        localStorage.removeItem('wishListCount')
        wishlistStore.wishlist = []
        wishlistStore.wishlistCount = 0

        if (authStore.auth) {
            await cartStore.cartSync()
            await router.push('/cart')

        } else {
            await router.push('/login')
        }
    } else {
        localStorage.removeItem('wishList')
        localStorage.removeItem('wishListCount')

        wishlistStore.wishlist = []
        wishlistStore.wishlistCount = 0

        await router.push('/cart')
    }
}





</script>

<style scoped>

</style>
