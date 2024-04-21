import {defineStore} from "pinia";
import {ref, watch} from "vue";

export const useWishlistStore = defineStore('wishlistStore', () => {

    const wishlistCount = ref(0);

    const wishlist = ref([]);


    const addWishlistItem = async (obj) => {
        const itemIsset = issetWishlistItem(obj.id)
        if (!itemIsset) {
            wishlist.value.push(obj)
            wishlistCount.value = wishlistCount.value + 1
            //localStorage.setItem('wishList', JSON.stringify(wishlist.value))
            //localStorage.setItem('wishListCount', JSON.stringify(wishlistCount.value))
        }
    }

    const removeWishlistItem = async (id) => {
        const obj = wishlist.value.find((obj) => obj.id === id)
        wishlist.value.splice(wishlist.value.indexOf(obj),1)
        wishlistCount.value = wishlistCount.value - 1
        //localStorage.setItem('wishList', JSON.stringify(wishlist.value))
        //localStorage.setItem('wishListCount', JSON.stringify(wishlistCount.value))
    }

    const issetWishlistItem = (id) => {
       return wishlist.value.some(obj => obj.id === id);
    }

    const getWishListFromLocalStorage = async () => {
        const wishListStorage = localStorage.getItem('wishList')
        const wishListCountStorage = localStorage.getItem('wishListCount')

        if (wishListStorage !== null) {
            wishlist.value = JSON.parse(wishListStorage)
        }
        if (wishListCountStorage !== null) {
            wishlistCount.value = JSON.parse(wishListCountStorage)
        }
    }

    function itemQuantityCalculator ()  {

        if (wishlist.value.length !== 0) {
            const quantityArr = wishlist.value.map((itemObj) => {
                return itemObj.quantity
            })
            wishlistCount.value = quantityArr.reduce((sum, quantity) => sum + quantity);

        } else {
            wishlistCount.value = 0
        }
        localStorage.setItem('wishList', JSON.stringify(wishlist.value))
        localStorage.setItem('wishListCount', JSON.stringify(wishlistCount.value))
    }

    watch(wishlist, itemQuantityCalculator, {deep: true})


    return {
        wishlistCount,
        wishlist,
        addWishlistItem,
        removeWishlistItem,
        issetWishlistItem,
        getWishListFromLocalStorage,
    }



});
