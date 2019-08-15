<template>
    <div class="product-view" v-if="product">
        <div class="user-img">
            <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
        </div>
        <div class="user-info">
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
            <router-link to="/products">Back to all products</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            if (this.products.length) {
                this.product = this.products.find((product) => product.id === this.$route.params.id);
            } else {
                axios.get(`/api/v1/products/${this.$route.params.id}`)
                    .then((response) => {
                        this.product = response.data.product
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
.user-img {
    flex: 1;
}
.user-img img {
    max-width: 160px;
}
.user-info {
    flex: 3;
    overflow-x: scroll;
}
</style>
