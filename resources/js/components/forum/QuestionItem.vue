<template>
  <div>
    <v-card class="mt-2">
      <v-card-title class="align-end fill-height">
        <router-link :to="{ name: 'question-detail', params: { slug: question.slug } }">{{ question.title }}</router-link> 
      </v-card-title>
      <v-card-text>
        <span>{{ question.user.name }} said {{ question.created_at }}</span>
        <span>| {{ question.reply_count }} replies</span>
        <v-spacer></v-spacer>
        <span class="text--primary">
          <div>{{ question.body.length > 200 ? question.body.substr(0, 200) + ' ...' : question.body }}</div>
        </span>
      </v-card-text>

      <v-card-actions>
        <v-btn
          text
          color="orange"
        >
          <router-link tag="button" :to="{ name: 'question-detail', params: { slug: question.slug } }">Read more</router-link>
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
    props: {
        question: Object,
    }
}
</script>

<style>

</style>