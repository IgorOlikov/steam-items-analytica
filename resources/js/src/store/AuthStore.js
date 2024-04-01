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
           localStorage.setItem('userInfo', response.data.user)
           auth.value = true
       } catch (err) {
           errorMessage.value = err.response.data.message
       }
    }

    const signUp = async (email, name, password, confirmPassword) => {
        if (password !== confirmPassword) {
            errorMessage.value = 'Пароли не совпадают'
        }else {
            try {
                const response = await axios.post(`${appDomain}${apiVersion}/auth/register`,{
                    email: email,
                    name: name,
                    password: password
                });
                localStorage.setItem('token', response.data.access_token)
                expiresIn.value = response.data.expires_in
                userInfo.value = response.data.user
                localStorage.setItem('userInfo', response.data.user)
                auth.value = true
            } catch (err) {
                errorMessage.value = err.response.data.message
            }
        }
    }

    const logout = async () => {
        try{
            const response = await axios.post(`${appDomain}${apiVersion}/auth/logout`, null,
                { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }
            );
            localStorage.removeItem('token')
            localStorage.removeItem('userInfo')
            auth.value = false;
        } catch (err) {
            console.log(err.response.data.message)
            localStorage.removeItem('token')
            localStorage.removeItem('userInfo')
            auth.value = false
        }
    }

    const refreshToken = async () => {
        try {
            const response = await axios.post(`${appDomain}${apiVersion}/auth/refresh-tokens`, null, {
                headers: {Authorization: `Bearer ${localStorage.getItem('token')}`}
            });
            localStorage.setItem('token', response.data.access_token)
            expiresIn.value = response.data.expires_in
            userInfo.value = response.data.user
            localStorage.setItem('userInfo', response.data.user)
        }catch (err) {
            console.log(err.response.data.message)
            await logout()
        }
    }

    const checkUserAuthStatus = async () => {
       const accessToken = localStorage.getItem('token')
        if (accessToken.length > 0) {
            userInfo.value = JSON.parse(localStorage.getItem('userInfo'))
            auth.value = true
        } else {
            auth.value = false
        }
    }

    return {
        auth,
        isAuth,
        sighIn,
        signUp,
        logout,
        refreshToken,
        checkUserAuthStatus,
        errorMessage,
        isErrorMessage,
        userInfo,
        expiresIn}
});
