import {defineStore} from "pinia";
import {computed, ref} from "vue";
export const useAuthStore
    = defineStore('authStore', () => {

        const auth = ref(false);
     const isAuth = computed (() => auth.value )

    const login = async () => {
        auth.value = true;
    }
    const logout = async () => {
        auth.value = false;
    }

    return { auth, isAuth, login, logout }
});
