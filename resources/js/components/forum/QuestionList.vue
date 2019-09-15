<template>
  <div>
    <question-item 
      v-for="question in questions"
      :key="question.path"
      :question="question"
      ></question-item>
  </div>
</template>

<script>
import QuestionItem from './QuestionItem';
export default {
  components: {
    QuestionItem,
  },
  props: {
    questions: Array,
  }
}
</script>

<style>

</style>