<template>
    <v-card class="mt-1">
      <v-card-title class="align-end fill-height">
        <span>{{ reply.user.name }} at {{ reply.updated_at }}</span>
        <v-spacer></v-spacer>
        <like :reply="reply"></like>
      </v-card-title>
      <v-card-text>
        <div v-if="!editing" v-html="reply.body"></div>
        <div v-else>
            <vue-simplemde v-model="editForm.body"/>
        </div>
      </v-card-text>
      <v-card-actions>
          <div v-if="!editing">
            <v-btn text color="primary" @click="editReply">Edit</v-btn>
            <v-btn text color="red" @click="deleteReply">delete</v-btn>
          </div>
          <div v-else>
            <v-btn text color="primary" @click="sumitUpdateForm">Update</v-btn>
            <v-btn text color="red" @click="editing = false">Cancel</v-btn>
          </div>
      </v-card-actions>
    </v-card>
</template>

<script>
import VueSimplemde from 'vue-simplemde';
import Marked from 'marked';
import Like from './like/Like';

export default {
    components: {
      VueSimplemde,
      Like
    },
    props: {
        reply: {
          type: Object,
          required: true,
        },
        questionSlug: {
          type: String,
          required: true,
        }
    },
    data() {
      return {
        editing: false,
        editForm: {
          body: '',
        }
      }
    },
    created() {
      this.editForm.body = this.reply.body;
      this.reply.body = Marked(this.reply.body);
    },
    methods: {
      deleteReply() {
        this.$emit('onDeletedReply');
      },
      editReply() {
        this.editing = true;
      },
      sumitUpdateForm() {
        axios.put(`/api/question/${this.questionSlug}/reply/${this.reply.id}`, {
            body: this.editForm.body,
        })
        .then(res => {
            this.editing = false;
            this.reply.body = Marked(res.data.reply.body);
            this.reply.updated_at = res.data.reply.updated_at;
        })
        .catch(error => console.log(error));
      }
    }
}
</script>

<style>

</style>