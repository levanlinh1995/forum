<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-form @submit.prevent="editCategory">
                <v-card>
                    <v-card-title>
                        <span class="headline">Update category</span>
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
        updatedItem: Object,
    },
    data() {
        return {
            form: {
                name: this.updatedItem.name,
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
        onEditCategory(data) {
            this.$emit('onEditCategory', data);
        },
        editCategory() {
            axios.put(`/api/category/${this.updatedItem.slug}`, this.form)
            .then(res => {
                this.onEditCategory(res.data);
                this.onCloseDialog();
            })
            .catch(error => console.log(error));
        }
    }
}
</script>

<style>

</style>