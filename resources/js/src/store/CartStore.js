import {defineStore} from "pinia";
import {ref} from "vue";

export const useCartStore = defineStore('cartStore', () => {

    const cartCount = ref(0)

    const cart = ref([])


    const addItem = async () => {
        //
    }

    const removeItem = async () => {
        //
    }



});
