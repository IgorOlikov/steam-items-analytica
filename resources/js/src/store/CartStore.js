import {defineStore} from "pinia";
import {ref} from "vue";
import {useAuthStore} from "@/store/AuthStore.js";
import axiosJwtApi from "@/Axios/Api.js";

export const useCartStore = defineStore('cartStore', () => {

    const authStore = useAuthStore()

    const cartCount = ref(0);

    const cart = ref([]);


    const addCartItem = async (obj) => {
        const itemIsset = issetCartItem(obj.id)
        if (!itemIsset) {
            cart.value.push(obj)
            cartCount.value = cartCount.value + 1
            localStorage.setItem('cart', JSON.stringify(cart.value))
            localStorage.setItem('cartCount', JSON.stringify(cartCount.value))
            if (authStore.auth) {
                const response = axiosJwtApi.post(`${authStore.appDomain}${authStore.apiVersion}`, {
                    product_id: obj.id
                })
            }
        }
    }

    const removeCartItem = async () => {
        //
    }

    const updateCartItemQuantity = async () => {
        //
    }

    const issetCartItem = (id) => {
        return cart.value.some(obj => obj.id === id);
    }

    const getCartFromLocalStorage = async () => {
        if (authStore.auth) {
            //get cart and cartCount from server
        } else {
            const cartStorage = localStorage.getItem('cart')
            const cartCountStorage = localStorage.getItem('cartCount')
            if (cartStorage !== null) {
                cart.value = JSON.parse(cartStorage)
            }
            if (cartCountStorage !== null) {
                cartCount.value = JSON.parse(cartCountStorage)
            }
        }
    }

    return {
        cartCount,
        cart,
        addCartItem,
        removeCartItem,
        updateCartItemQuantity,
        issetCartItem,


    }



});
