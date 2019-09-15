<template>
  <div>
      <div v-if="replies.length > 0">
        <h3>Replies</h3>
        <reply-item
            v-for="(reply, index) in replies"
            :key="reply.id"
            :reply="reply"
            :questionSlug="questionSlug"
            @onDeletedReply="deleteReply(index, reply.id)"
            ></reply-item>
      </div>
  </div>
</template>

<script>
import ReplyItem from './ReplyItem';

export default {
    props: {
        questionSlug: String,
        replies: {
            type: Array,
            default: function() {
                return [];
            }
        },
    },
    components: {
        ReplyItem
    },
    created() {
        Echo.private(`reply-added`)
            .listen('ReplyAddedEvent', (e) => {
                this.replies.unshift(e.reply);
                this.$emit('onReplyAdded', e.reply);
            });

         Echo.private(`reply-deleted`)
            .listen('ReplyDeletedEvent', (e) => {
                for(let i = 0; i < this.replies.length; i++) {
                    if (this.replies[i].id == e.replyId) {
                        this.replies.splice(i, 1);
                        this.$emit('onReplyDeleted', e.replyId);
                    }
                }
            });
    },
    methods: {
        deleteReply(index, reply_id) {
            axios.delete(`/api/question/${this.questionSlug}/reply/${reply_id}`)
                .then(res => {
                })
                .catch(error => console.log(error));
        }
    },
}
</script>

<style>

</style>
