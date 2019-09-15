<template>
  <v-container>
    <v-form @submit.prevent="updateQuestion">
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
            Update
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
            updatedQuestion: null,
        }
    },
    created() {
        this.getCategoryList();
        this.getUpdatedQuestion();
    },
    methods: {
        updateQuestion() {
            axios.put(`/api/question/${this.updatedQuestion.slug}`, this.form)
                .then(res => {
                    this.updatedQuestion = res.data.data;
                    
                    this.$router.push({ name: 'question-detail', params: { 'slug':  this.updatedQuestion.slug} });
                })
                .catch(error => console.log(error));
        },
        getCategoryList() {
            axios.get('/api/category')
                .then(res => {
                    this.categoryList = res.data.data;
                })
                .catch(error => console.log(error));
        },
        getUpdatedQuestion() {
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(res => {
                    this.updatedQuestion = res.data.data;
                    this.form.title = this.updatedQuestion.title;
                    this.form.category_id = this.updatedQuestion.category ? this.updatedQuestion.category.id : null;
                    this.form.body = this.updatedQuestion.body;
                })
                .catch(error => console.log(error));
        },
    }
}
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>