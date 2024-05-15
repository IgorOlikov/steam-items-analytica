import axios from "axios";
import {useAuthStore} from "@/store/AuthStore.js";
import router from "@/router/router.js";


const axiosJwtApi = axios.create()

axiosJwtApi.interceptors.request.use((config) => {
    config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
    config.headers.Accept = 'application/json'
    config.headers["Content-Type"] = 'application/json'

    return config;
})


axiosJwtApi.interceptors.response.use((response) => {

    return response
}, async function (error){

    const authStore = useAuthStore();


    console.log(error)

    const originalRequest = error.config

    if (error.response.status === 401 && !originalRequest._retry) {
       if (authStore.auth) {
           originalRequest._retry = true;
           try {
               const response = await axios.post(`http://localhost/api/v1/auth/refresh-tokens`, null, {
                   withCredentials: true,
                   headers: {
                       'Access-Control-Allow-Origin': '*',
                       'Content-Type': 'application/json',
                       'Accept': 'application/json'
                   }
               });
               localStorage.setItem('token', response.data.access_token)
               authStore.userInfo.value = response.data.user
               authStore.expiresIn.value = response.data.expires_in
           } catch (err) {
               originalRequest._retry = true  // refresh with error -> logout
               console.log('logout')
               authStore.auth = false
               localStorage.removeItem('token')
               localStorage.removeItem('userInfo')
               authStore.userInfo = {}
               await router.push('/')

           }
       } else {
           originalRequest._retry = true; // not 401 status
           console.log('error status not 401')
       }

        return axiosJwtApi(originalRequest);
    }
})

export default axiosJwtApi;
