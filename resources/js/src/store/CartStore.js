import {defineStore} from "pinia";
import {ref, watch} from "vue";
import {useAuthStore} from "@/store/AuthStore.js";
import axiosJwtApi from "@/Axios/Api.js";

export const useCartStore = defineStore('cartStore', () => {

    const authStore = useAuthStore()

    const cartCount = ref(0);

    const cart = ref([]);


    const addCartItem = async (obj) => {
        const itemIsset = issetCartItem(obj.id)
        if (!itemIsset) {

            if (authStore.auth) {
                try {
                    const response = await axiosJwtApi.post(`${authStore.appDomain}${authStore.apiVersion}/cart`, {
                        product_id: obj.id
                })
                cart.value.push(obj)
                } catch (err) {
                    console.log(err)
                }
            } else {
                cart.value.push(obj)
            }
        }
    }

    const removeCartItem = async (id) => {
        const obj = cart.value.find((obj) => obj.id === id)

        if (authStore.auth) {
            try {
                const response = await axiosJwtApi.delete(`${authStore.appDomain}${authStore.apiVersion}/cart/${obj.id}`)
                cart.value.splice(cart.value.indexOf(obj),1)
            } catch (err) {
                console.log(err)
            }
        } else {
            cart.value.splice(cart.value.indexOf(obj),1)
        }
    }

    const updateCartItemQuantity = async (id, quantity) => {
        const obj = cart.value.find((obj) => obj.id === id)

        obj.quantity = quantity

        const index = cart.value.indexOf(obj)

        if (index !== -1) {
            if (authStore.auth) {
                try {
                    const response = await axiosJwtApi.put(`${authStore.appDomain}${authStore.apiVersion}/cart/${id}`,{
                        quantity: quantity
                    })
                    cart.value[index] = obj
                } catch (err) {
                    console.log(err)
                }
            } else {
                cart.value[index] = obj
            }
        }
    }

    const issetCartItem = (id) => {
        return cart.value.some(obj => obj.id === id);
    }

    const getCart = async () => {

        if (authStore.auth) {
            try {
                const response = await axiosJwtApi.get(`${authStore.appDomain}${authStore.apiVersion}/cart`)

                if (response.data.length !== 0) {
                    cart.value = response.data

                    const quantityArr = cart.value.map((itemObj) => {
                        return itemObj.quantity
                    })
                    cartCount.value = quantityArr.reduce((sum, quantity) => sum + quantity);

                    localStorage.setItem('cart', JSON.stringify(cart.value))
                    localStorage.setItem('cartCount', JSON.stringify(cartCount.value))
                }
            } catch (err) {
                console.log(err)
            }
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

     function quantityCalculator ()  {

        if (cart.value.length !== 0) {
            const quantityArr = cart.value.map((itemObj) => {
                return itemObj.quantity
            })
            cartCount.value = quantityArr.reduce((sum, quantity) => sum + quantity);

        } else {
            cartCount.value = 0
        }
        localStorage.setItem('cart', JSON.stringify(cart.value))
        localStorage.setItem('cartCount', JSON.stringify(cartCount.value))
    }

    watch(cart,  quantityCalculator, {deep: true})



    return {
        cartCount,
        cart,
        addCartItem,
        removeCartItem,
        updateCartItemQuantity,
        issetCartItem,
        getCart,
        quantityCalculator,
    }



});
