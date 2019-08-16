<template>
    <div>
        <div class="row">
            <div class="md-form mt-0 col-md-8">
                <input class="form-control" type="text" @keyup.enter="getProducts()" v-model="searchName" placeholder="Search" aria-label="Search">
            </div>
            <div class="btn-wrapper mt-2 col-md-4">
                <router-link to="/products/new" class="btn btn-success btn-sm">New</router-link>
                <router-link to="/products/import" class="btn btn-dark btn-sm">CSV</router-link>
                <router-link to="/products/scheduler" class="btn btn-info btn-sm text-white">Scheduler</router-link>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <template v-if="!products.total">
                    <tr>
                        <td colspan="4" class="text-center">No Products Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}</td>
                        <td class="actions">
                            <router-link :to="`/products/${product.id}/show`" class="btn btn-primary btn-sm">Show</router-link>
                            <router-link :to="`/products/${product.id}/edit`" class="btn btn-warning btn-sm">Edit</router-link>
                            <button @click="destroy(product.id)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <vue-pagination  :pagination="products"
                         @paginate="getProducts()"
                         :offset="4">
        </vue-pagination>
    </div>
</template>

<script>
    import VuePagination from './Pagination';

    export default {
        name: 'list',
        components: {
            VuePagination
        },
        data() {
            return {
                products: {},
                searchName: '',
            }
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                const searchByName = this.searchName !== '' ?  '&searchJoin=and&search=name:'+this.searchName : '';
                axios.get('/api/v1/products?page=' + this.products.current_page + searchByName)
                    .then((response) => {
                        this.products = response.data;
                    });
            },
            destroy(produtoID) {

                // would need I to use the sweetAlert?
                if(confirm("Do you really want to delete?")) {
                    axios.delete(`/api/v1/products/${produtoID}`)
                        .then((response) => {
                            toastr.info(response.data.message);
                            this.getProducts();
                        }).catch(error => {
                            console.log(error);
                    })
                };
            }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
.actions {
    width: 30%;
}
</style>
