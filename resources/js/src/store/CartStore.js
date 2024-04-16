import {defineStore} from "pinia";
import {ref} from "vue";

export const useCartStore = defineStore('cartStore', () => {

    const cartCount = ref(0);

    const cart = ref([]);


    const addCartItem = async () => {
        //wishlistCount.value  = wishlistCount.value + obj.quantity
    }

    const removeCartItem = async () => {
        //
    }

    const updateCartItemQuantity = async () => {
        //
    }


    return {
        cartCount,
        cart,
        addCartItem,
        removeCartItem,
        updateCartItemQuantity

    }



});
