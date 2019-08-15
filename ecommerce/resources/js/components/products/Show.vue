<template>
    <div class="product-view" v-if="product">
        <div class="product-view-img">
            <img src="/img/product-default.jpg" alt="">
        </div>
        <div class="product-view-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ product.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ product.name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ product.description }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ product.price }}</td>
                </tr>
            </table>
            <router-link to="/products">Back</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'show',
        created() {
            if (this.products.length) {
                this.product = this.products.find((product) => product.id === parseInt(this.$route.params.id));
            } else {
                axios.get(`/api/v1/products/${this.$route.params.id}`)
                    .then((response) => {
                        this.product = response.data.data
                    });
            }
        },
        data() {
            return {
                product: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            products() {
                return this.$store.getters.products;
            }
        }
    }
</script>

<style scoped>
.product-view {
    display: flex;
    align-items: center;
}
.product-view-img {
    flex: 1;
}
.product-view-img img {
    max-width: 160px;
}
.product-view-info {
    flex: 3;
    overflow-x: scroll;
}
</style>
