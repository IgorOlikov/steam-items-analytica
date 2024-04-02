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
        path: '/profile',
        component: ProfilePage,
        name: 'profile',
        meta: { authRequired: true }
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



    if (to.name === 'login' && authStore.auth) {
        router.push('/')
        //do nothing or to home
    } else if (to.name === 'register' && authStore.auth) {
        router.push('/')

    } else if (to.meta.authRequired && !authStore.auth) { // треб авториз и польз не авториз -> login
        next('/login')
    } else {
        next();
    }
})

export default router;
