import axios from "axios";
import {useAuthStore} from "@/store/AuthStore.js";


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
        console.log(error)
    const originalRequest = error.config
    if (error.response.status === 500 && !originalRequest._retry) {
        originalRequest._retry = true;
        try {
            alert('before refresh request')
            alert(localStorage.getItem('token'))

            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
            alert('get cooke before refresh request')
            alert(getCookie('token'))

            const newToken = await axios.post(`http://localhost/api/v1/auth/refresh-tokens`,null, {
                withCredentials:true,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
            }
            })
            alert('refresh request отработал')
            alert(newToken.data.access_token)
            console.log(newToken)
            localStorage.setItem('token', newToken.data.access_token)
        } catch (err) {

        }
        //return axiosJwtApi(originalRequest);
    }
})

export default axiosJwtApi;
