import {createRouter, createWebHistory} from "vue-router";
import HomePage from "@/pages/HomePage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import LoginPage from "@/pages/LoginPage.vue";
import CatalogPage from "@/pages/CatalogMainPage.vue";
import CategoryIdPage from "@/pages/CategoryIdPage.vue";
import CatalogCategoryPage from "@/pages/CategoryIdPage.vue";
import CategoryProductPage from "@/pages/CategoryIdProductPage.vue";
import CatalogMainPage from "@/pages/CatalogMainPage.vue";
import CatalogCategoryIdPage from "@/pages/CategoryIdPage.vue";
import CategoryProductsPage from "@/pages/CategoryIdProductPage.vue";
import ProductPage from "@/pages/CategoryIdProductIdPage.vue";
import CategoryIdProductPage from "@/pages/CategoryIdProductPage.vue";
import CategoryIdProductIdPage from "@/pages/CategoryIdProductIdPage.vue";


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
        path: '/catalog/category/:categoryId', component: CategoryIdPage
    },
    {
        path: '/catalog/category/:categoryId/product', component: CategoryIdProductPage
    },
    {
        path: '/catalog/category/:categoryId/product/:productId', component: CategoryIdProductIdPage
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
