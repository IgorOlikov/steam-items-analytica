import {defineStore} from "pinia";
import {ref} from "vue";

export const useWishlistStore = defineStore('wishlistStore', () => {

    const wishlistCount = ref(0)

    const wishlist = ref([])


    const addItem = async () => {
        //
    }

    const removeItem = async () => {
        //
    }



});
