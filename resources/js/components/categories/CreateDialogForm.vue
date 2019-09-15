<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-form @submit.prevent="createNewCategory">
                <v-card>
                    <v-card-title>
                        <span class="headline">Create new category</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-text-field
                                v-model="form.name"
                                label="Name*"
                                type="text"
                                required
                            ></v-text-field>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="blue darken-1" type="submit">Submit</v-btn>
                        <v-btn color="default" @click="closeDialog">Close</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </div>
    
</template>

<script>
export default {
    props: {
        dialog: Boolean,
    },
    data() {
        return {
            form: {
                name: ''
            },
            snackbar: {
                show: false,
                message: '',
                timeout: 3000,
            },
        }
    },
    methods: {
        closeDialog() {
            this.onCloseDialog();
        },
        onCloseDialog() {
            this.$emit('onCloseDialog');
        },
        onCreateCategory(data) {
            this.$emit('onCreateCategory', data);
        },
        createNewCategory() {
            axios.post('/api/category', this.form)
                .then(res => {
                    this.form.name = '';
                    this.onCreateCategory(res.data);
                    this.onCloseDialog();
                })
                .catch(error => console.log(error))
        }
    }
}
</script>

<style>

</style>