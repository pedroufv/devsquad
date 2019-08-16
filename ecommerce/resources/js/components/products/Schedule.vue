<template>
    <div class="product-scheduler">
        <span>Your file sent will be imported automatically by tasks schedule</span>
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
                        <input type="submit" value="Import" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>

<script>

    export default {
        name: 'scheduler',
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
                    toastr.error('file is mandatory!');
                    return;
                }

                formData.append('file', this.file);

                axios.post('/api/v1/products/schedule', formData, { headers: { 'Content-Type': 'multipart/form-data'}})
                    .then((response) => {
                        toastr.success(response.data.message);
                        this.$router.push('/products');
                    }).catch((error) => {
                        toastr.error('import not works!');
                    });
            }
        }
    }
</script>

