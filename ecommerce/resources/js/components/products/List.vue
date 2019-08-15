<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/products/new" class="btn btn-success btn-sm">New</router-link>
        </div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <template v-if="!products.length">
                    <tr>
                        <td colspan="4" class="text-center">No Products Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}</td>
                        <td class="actions">
                            <router-link :to="`/products/${product.id}`" class="btn btn-primary btn-sm">Show</router-link>
                            <router-link :to="`/products/${product.id}`" class="btn btn-warning btn-sm">Edit</router-link>
                            <button @click="destroy(product.id)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (this.products.length) {
                return;
            }

            this.$store.dispatch('getProducts');
        },
        methods: {
            destroy(produtoID) {

                // would need I to use the sweetAlert?
                if(confirm("Do you really want to delete?")) {
                    axios.delete(`/api/v1/products/${produtoID}`)
                        .then((response) => {
                            this.$router.go('/products');
                        }).catch(error => {
                        console.log(error);
                    })
                };
            }
        },
        computed: {
            products() {
                return this.$store.getters.products;
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
