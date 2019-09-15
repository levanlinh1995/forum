<template>
  <v-container>
    <v-row no-gutters class="d-flex justify-space-between">
      <v-col cols="8">
        <question-list :questions="questionList"></question-list>
      </v-col>
      <v-col cols="3">
        <app-sidebar></app-sidebar>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import QuestionList from './QuestionList';
import AppSidebar from './AppSidebar';

export default {
  components: {
    QuestionList,
    AppSidebar,
  },
  computed: {
    questionList() {
      return this.$store.getters['question/all'];
    }
  },
  created() {
    this.$store.dispatch('question/getAll');
  },
}
</script>

<style>

</style>