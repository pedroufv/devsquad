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
                    <th>Category</th>
                    <td>
                        <select v-model="product.category_id">
                            <option disabled value="">Please select one</option>
                            <option v-for="category in categories" v-bind:value="category.id">
                                {{ category.name}}
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <input type="file" id="file" ref="file" @change="handleFileUpload()"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/products" class="btn btn-light">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Edit" class="btn btn-primary">
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
        name: 'edit',
        data() {
            return {
                product: {},
                categories: {},
                errors: null
            };
        },
        mounted() {
            axios.get(`/api/v1/products/${this.$route.params.id}`)
                .then((response) => {
                    this.product = response.data.data
                });

            axios.get('/api/v1/categories')
                .then((response) => {
                    this.categories = response.data;
                }).catch((error) => {
                    console.log('categories not found')
            });
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            handleFileUpload(){
                this.product.file = this.$refs.file.files[0];
            },
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.product, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                let formData = new FormData();
                formData.append('_method', 'PATCH');
                formData.append('id', this.product.id);
                formData.append('name', this.product.name);
                formData.append('description', this.product.description);
                formData.append('price', this.product.price);
                formData.append('category_id', this.product.category_id);

                if(this.product.file) {
                    formData.append('file', this.product.file);
                }

                axios.post('/api/v1/products/'+this.product.id, formData, { headers: { 'Content-Type': 'multipart/form-data'}})
                    .then((response) => {
                        toastr.success(response.data.message);
                        this.$router.push('/products');
                    }).catch((error) => {
                        this.errors = error.response.data.errors;
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

