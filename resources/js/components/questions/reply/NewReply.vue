<template>
    <v-card class="mt-2">
        <v-card-title class="align-end fill-height">
          Create new reply
        </v-card-title>
        <v-card-text>
          <vue-simplemde v-model="body"/>
        </v-card-text>
        <v-card-actions>
            <v-btn color="green darken-1" @click="createNew">Create</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import VueSimplemde from 'vue-simplemde';

export default {
    components: {
        VueSimplemde
    },
    props: {
        questionSlug: String,
    },
    data() {
        return {
            body: ''
        }
    },
    methods: {
        createNew() {
            axios.post(`/api/question/${this.questionSlug}/reply`, {
                body: this.body,
            })
                .then(res => {
                    this.body = '';
                })
                .catch(error => console.log(error));
        }
    }
}
</script>

<style>
     @import '~simplemde/dist/simplemde.min.css';
</style>