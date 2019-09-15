<template>
  <div>
    <v-container fluid="">
      <v-card>
        <v-card-title class="align-end fill-height">
          {{ question.title }}
          <v-btn
            text
            color="orange"
          >
            {{ question.reply_count }} replies
          </v-btn>
        </v-card-title>
        <v-card-text>
          <span>{{ question.user ? question.user.name : 'unknown' }} said {{ question.created_at }}</span>
          <v-spacer></v-spacer>
          <div class="text--primary mt-5">
            <div v-html="question.body"></div>
          </div>
        </v-card-text>
        <v-card-actions>
            <router-link :to="{ name: 'question-edit', params: { slug: question.slug } }" tag="button">
              <v-btn color="green darken-1" type="submit">Edit</v-btn>
            </router-link>
            <v-btn color="red" class="ml-1" @click="deleteQuestion">Delete</v-btn>
            <router-link :to="{ name: 'forum' }" tag="button" class="ml-1">
              <v-btn color="grey">Back</v-btn>
            </router-link>
        </v-card-actions>
      </v-card>
    </v-container>
    <v-container>
      <reply-list 
        :replies="question.replies" 
        :questionSlug="question.slug"
        @onReplyAdded="replyAdded"
        @onReplyDeleted="replyDeleted"
        class="mt-4"></reply-list>
      
      <new-reply
        :questionSlug="question.slug"
      ></new-reply>
    </v-container>
  </div>
</template>

<script>
import Marked from 'marked';
import ReplyList from './reply/ReplyList';
import NewReply from './reply/NewReply';

export default {
  components: {
    ReplyList,
    NewReply,
  },
  data() {
    return {
      question: {},
    }
  },
  created() {
    this.getQuestion();
  },
  methods: {
    getQuestion() {
      axios.get(`/api/question/${this.$route.params.slug}`)
        .then(res => {
          this.question = res.data.data;
          this.question.body = Marked(this.question.body);
        })
        .catch(error => console.log(error));
    },
    deleteQuestion() {
      axios.delete(`/api/question/${this.$route.params.slug}`)
        .then(res => {
          this.$router.push({ name: 'forum' });
        })
        .catch(error => console.log(error));
    },
    replyAdded() {
      this.question.reply_count++;
    },
    replyDeleted() {
      this.question.reply_count--;
    }
  }
}
</script>

<style>

</style>