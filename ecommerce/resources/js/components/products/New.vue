<template>
    <div class="product-new">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="product.name" placeholder="Product Name"/>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <input type="text" class="form-control" v-model="product.description" placeholder="Product Description"/>
                    </td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>
                        <input type="text" class="form-control" v-model="product.price" placeholder="Product Price"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/products" class="btn btn-light">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'new',
        data() {
            return {
                product: {
                    name: null,
                    description: null,
                    price: null,
                    category_id: 1
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.product, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/v1/products', this.$data.product)
                    .then((response) => {
                        this.$router.push('/products');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            maximum: 64,
                            message: 'Must be at max 64 characters long'
                        }
                    },
                    description: {
                        presence: true,
                    },
                    price: {
                        presence: true,
                        numericality: true,
                    },
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>

