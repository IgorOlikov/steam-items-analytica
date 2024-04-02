import {createRouter, createWebHistory} from "vue-router";
import HomePage from "@/pages/HomePage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import LoginPage from "@/pages/LoginPage.vue";
import CatalogMainPage from "@/pages/CatalogMainPage.vue";
import CategorySlugProductSlugPage from "@/pages/CategorySlugProductSlugPage.vue";
import CategorySlugProductPage from "@/pages/CategorySlugProductPage.vue";
import CategorySlugPage from "@/pages/CategorySlugPage.vue";
import ProfilePage from "@/pages/ProfilePage.vue";
import {useAuthStore} from "@/store/AuthStore.js";
import VerifyEmailPage from "@/pages/VerifyEmailRequestPage.vue";
import ForgotPasswordPage from "@/pages/ForgotPasswordPage.vue";
import VerifyEmailRequestPage from "@/pages/VerifyEmailRequestPage.vue";
import SendEmailVeryficationPage from "@/pages/SendEmailVeryficationPage.vue";


const routes = [
    {
        path: '/',
        component: HomePage,
        name: 'home',
        meta: { authRequired: false }
    },
    {
        path: '/about',
        component: AboutPage,
        name: 'about',
        meta: { authRequired: false }
    },
    {
        path: '/register',
        component: RegisterPage,
        name: 'register',
        meta: { authRequired: false }
    },
    {
        path: '/login',
        component: LoginPage,
        name: 'login',
        meta: { authRequired: false }
    },
    {
        path: '/verify-email',
        component: SendEmailVeryficationPage,
        name: 'verifyEmail',
        meta: { authRequired: true, emailVerifyRequired: false }
    },
    {
        path: '/verify-email-request',
        component: VerifyEmailRequestPage,
        name: 'verifyEmailRequest',
        meta: { authRequired: true, emailVerifyRequired: false }
    },
    {
        path: '/forgot-password',
        component: ForgotPasswordPage,
        name: 'forgotPassword',
        meta: { authRequired: false }
    },
    {
        path: '/profile',
        component: ProfilePage,
        name: 'profile',
        meta: { authRequired: true, emailVerifyRequired: true  }
    },
    {
        path: '/catalog',
        component: CatalogMainPage,
        name: 'catalog',
        meta: { authRequired: false }
    },
    {
        path: '/catalog/category/:categorySlug',
        component: CategorySlugPage,
        name: 'catalogCategory',
        meta: { authRequired: false }
    },
    {
        path: '/catalog/category/:categorySlug/product',
        component: CategorySlugProductPage,
        name: 'categoryProducts',
        meta: { authRequired: false }
    },
    {
        path: '/catalog/category/:categorySlug/product/:productSlug',
        component: CategorySlugProductSlugPage,
        name: 'categoryProduct',
        meta: { authRequired: false }
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();



   if ((to.name === 'register' || to.name === 'login') && authStore.auth) {
       console.log('Вы уже авторизованы!')
       next('/')

   } else if (to.meta.authRequired && !authStore.auth) {
       console.log('Вы не авторизованы!')
       next('/login')

   } else if (to.name === 'verifyEmail' || to.name === 'verifyEmailRequest') {
       if (!(to.meta.authRequired &&  to.meta.emailVerifyRequired) && (authStore.auth && authStore.userInfo.value.email_verified)) {
           console.log('Почта уже подтверждена!')
           next('/')
       }
   }  else if ((to.meta.authRequired &&  to.meta.emailVerifyRequired) && !(authStore.auth && authStore.userInfo.value.email_verified)) {
        console.log('Потча не подтверждена или пользователь не авторизован!')
        if (!authStore.auth) {
            next('/login')
        } else if (authStore.auth && !authStore.userInfo.value.email_verified) {
            next('/verify-email')
        }
   } else {
       next();
   }
});

export default router;
