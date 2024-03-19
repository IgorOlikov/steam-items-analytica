import {createRouter, createWebHistory} from "vue-router";
import HomePage from "@/pages/HomePage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import LoginPage from "@/pages/LoginPage.vue";
import CatalogPage from "@/pages/CatalogMainPage.vue";
import CategoryIdPage from "@/pages/CatalogCategoryIdPage.vue";
import CatalogCategoryPage from "@/pages/CatalogCategoryIdPage.vue";
import CategoryProductPage from "@/pages/CategoryProductsPage.vue";
import CatalogMainPage from "@/pages/CatalogMainPage.vue";
import CatalogCategoryIdPage from "@/pages/CatalogCategoryIdPage.vue";
import CategoryProductsPage from "@/pages/CategoryProductsPage.vue";
import ProductPage from "@/pages/ProductPage.vue";


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
        path: '/catalog/category/:id', component: CatalogCategoryIdPage
    },
    {
        path: '/category/:id/products', component: CategoryProductsPage
    },
    {
        path: '/category/:id/products', component: CategoryProductsPage
    },
    {
        path: '/catalog/category/:categoryId/products/:productId', component: ProductPage
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
