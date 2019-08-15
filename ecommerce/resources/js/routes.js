import Home from "./components/Home";
import Login from "./components/auth/Login";
import ProductsMain from './components/products/Main.vue';
import ProductsList from './components/products/List.vue';
import NewProduct from './components/products/New.vue';
import ImportProducts from './components/products/Import.vue';
import EditProduct from './components/products/Edit.vue';
import Product from './components/products/Show.vue';

export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/products',
        component: ProductsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ProductsList
            },
            {
                path: 'new',
                component: NewProduct
            },
            {
                path: 'import',
                component: ImportProducts
            },
            {
                path: ':id/edit',
                component: EditProduct
            },
            {
                path: ':id/show',
                component: Product
            }
        ]
    }
];
