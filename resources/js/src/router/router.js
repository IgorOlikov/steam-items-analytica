import {createRouter, createWebHistory} from "vue-router";
import HomePage from "@/pages/HomePage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import LoginPage from "@/pages/LoginPage.vue";
import CatalogPage from "@/pages/CatalogPage.vue";
import CategoryIdPage from "@/pages/CatalogCategoryPage.vue";
import CatalogCategoryPage from "@/pages/CatalogCategoryPage.vue";
import CategoryProductPage from "@/pages/CategoryProductPage.vue";


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
        path: '/catalog', component: CatalogPage
    },
    {
        path: '/catalog/category/:id', component: CatalogCategoryPage
    },
    {
        path: '/category/:id/product', component: CategoryProductPage
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
