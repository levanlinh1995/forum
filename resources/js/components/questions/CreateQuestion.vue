<template>
  <v-container>
    <v-form @submit.prevent="createQuestion">
        <v-text-field
            v-model="form.title"
            label="Title*"
            type="text"
            required
        ></v-text-field>
        <v-select
          :items="categoryList"
          item-value="id"
          item-text="name"
          v-model="form.category_id"
          label="Category*"
          outlined
        ></v-select>
        <vue-simplemde v-model="form.body"/>
        <v-btn
            color="success"
            class="mr-4"
            type="submit"
        >
            Create
        </v-btn>
    </v-form>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde';

export default {
    components: {
        VueSimplemde,
    },
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null,
            },
            categoryList: [],
        }
    },
    created() {
        this.getCategoryList();
    },
    methods: {
        getCategoryList() {
            axios.get('/api/category')
                .then(res => {
                    this.categoryList = res.data.data;
                })
                .catch(error => console.log(error));
        },
        createQuestion() {
            axios.post('/api/question', this.form)
                .then(res => {
                    let question = res.data.data;
                    this.$router.push({ name: 'question-detail', params: { 'slug':  question.slug} });
                })
                .catch(error => console.log(error));
        }
    }
}
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>