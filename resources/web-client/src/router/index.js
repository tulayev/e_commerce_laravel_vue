import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import ProductDetails from '../views/ProductDetails'
import Cart from '../views/Cart'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/product/:id',
        name: 'productDetails',
        component: ProductDetails,
        params: true
    },
    {
        path: '/cart/:id?',
        name: 'cart',
        component: Cart,
        params: true
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
