import {createRouter, createWebHistory} from "vue-router";
import HomePage from "@/pages/HomePage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import LoginPage from "@/pages/LoginPage.vue";
import CategoryIdPage from "@/pages/CategorySlugPage.vue";
import CatalogMainPage from "@/pages/CatalogMainPage.vue";
import CategoryIdProductPage from "@/pages/CategorySlugProductPage.vue";
import CategoryIdProductIdPage from "@/pages/CategorySlugProductSlugPage.vue";
import CategorySlugProductSlugPage from "@/pages/CategorySlugProductSlugPage.vue";
import CategorySlugProductPage from "@/pages/CategorySlugProductPage.vue";
import CategorySlugPage from "@/pages/CategorySlugPage.vue";


const routes = [
    {
        path: '/', component: HomePage
    },
    {
        path: '/about', component: AboutPage
    },
    {
        path: '/register', component: RegisterPage
    },
    {
        path: '/login', component: LoginPage
    },
    {
        path: '/catalog', component: CatalogMainPage
    },
    {
        path: '/catalog/category/:categorySlug', component: CategorySlugPage
    },
    {
        path: '/catalog/category/:categorySlug/product', component: CategorySlugProductPage
    },
    {
        path: '/catalog/category/:categorySlug/product/:productSlug', component: CategorySlugProductSlugPage
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
