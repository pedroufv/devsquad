<template>
    <div class="product-new">
        <form @submit.prevent="add">
            <table class="table">

                <tr>
                    <th>CSV</th>
                    <td>
                        <input type="file" id="file" ref="file" @change="handleFileUpload()"/>
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
    </div>
</template>

<script>

    export default {
        name: 'import',
        data() {
            return {
                file: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            add() {

                let formData = new FormData();

                if(!this.file) {
                    alert('file is mandatory!')
                    return;
                }

                formData.append('file', this.file);

                axios.post('/api/v1/products/import', formData, { headers: { 'Content-Type': 'multipart/form-data'}})
                    .then((response) => {
                        this.$router.push('/products');
                    }).catch((error) => {
                        console.log('import not works!');
                    });
            }
        }
    }
</script>

