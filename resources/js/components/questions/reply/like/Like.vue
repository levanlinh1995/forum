<template>
  <div>
      <span>
        {{ reply.likedCount }}
        <v-btn icon @click="likeIt">
            <v-icon :color="color">mdi-thumb-up</v-icon>
        </v-btn></span>
  </div>
</template>

<script>
export default {
    props:{
        reply: Object,
    },
    computed: {
        color: function() {
            return this.reply.liked ? 'blue' : 'grey';
        }
    },
    created() {
        Echo.private(`like-reply.${this.reply.id}`)
                    .listen('LikeReplyEvent', (e) => {
                        this.reply.likedCount = e.likedCount;
                    });
    },
    methods: {
        likeIt() {
            this.reply.liked ? this.desc() : this.incr();
            this.reply.liked = !this.reply.liked;
        },
        incr() {
            axios.post(`/api/like/${this.reply.id}`)
            .then(res => {})
            .catch(error => console.log(error))
        },
        desc() {
            axios.delete(`/api/like/${this.reply.id}`)
            .then(res => {})
            .catch(error => console.log(error))
        }
    }
}
</script>

<style>

</style>