import {defineStore} from "pinia";
import {computed, ref} from "vue";
import axios from "axios";
export const useAuthStore
    = defineStore('authStore', () => {

    const userInfo = ref([]);

    const expiresIn = ref();

    const auth = ref(false);

    const errorMessage = ref('')

    const appDomain = 'http://localhost';

    const apiVersion = '/api/v1';

    const isErrorMessage = computed(() => {
        return errorMessage.value.length !== 0;
    })

    const isAuth = computed (() => auth.value )

    const sighIn = async (email, password) => {
       try {
           const response = await axios.post(`${appDomain}${apiVersion}/auth/login`,{
               email: email,
               password: password
           });

           localStorage.setItem('token', response.data.access_token)
           expiresIn.value = response.data.expires_in
           userInfo.value = response.data.user
           auth.value = true
       }catch (err) {
           errorMessage.value = err.response.data.message
       }
    }
    const signUp = async () => {

    }

    const logout = async () => {
        auth.value = false;
    }

    const refreshToken = async () => {

    }



    return { auth, isAuth, sighIn, signUp, logout , errorMessage, isErrorMessage, userInfo, expiresIn}
});
