import {defineStore} from "pinia";
import {ref} from "vue";

export const useWishlistStore = defineStore('wishlistStore', () => {

    const wishlistCount = ref(0);

    const wishlist = ref([]);


    const addWishlistItem = async (obj) => {

        console.log(obj)
        if (wishlist.value.length !== 0) {
            const itemIsset = issetWishlistItem(obj.id)

            console.log(itemIsset)
            if (!itemIsset) {
                wishlist.value.push(obj)
                wishlistCount.value = wishlistCount.value + 1
            }
        } else {
            wishlist.value.push(obj)
            wishlistCount.value = wishlistCount.value + 1
        }
    }

    const removeWishlistItem = async (id) => {
        const obj = wishlist.value.find((obj) => obj.id === id)
        wishlist.value.splice(wishlist.value.indexOf(obj),1)
        wishlistCount.value = wishlistCount.value - 1
    }

    const issetWishlistItem = (id) => {
       return  wishlist.value.some(obj => obj.id === id);
    }


    return {
        wishlistCount,
        wishlist,
        addWishlistItem,
        removeWishlistItem,
        issetWishlistItem,
    }



});
