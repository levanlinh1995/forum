<template>
  <div>
    <v-toolbar>
      <v-toolbar-title>LVL FORUM</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="isAuthenticated" class="mr-2">
        <v-btn text=""><notification></notification></v-btn>
      </v-toolbar-items>
      <v-toolbar-items>
        <router-link
          v-for="item in items"
          :key="item.title"
          :to="item.to"
          v-show="item.show"
          tag="v-btn">
          {{ item.title }}
        </router-link>
        <v-btn v-if="isAuthenticated"><strong>Welcome:</strong> {{ userName }}</v-btn>
      </v-toolbar-items>
    </v-toolbar>
  </div>
</template>

<script>
import Notification from './notification/Notification';
export default {
  components: {
    Notification,
  },
  computed: {
    items() {
      return [
        { title: 'Forum', to: '/forum', show: true },
        { title: 'Ask Question', to: '/ask', show: this.isAuthenticated },
        { title: 'Category', to: '/categories', show: this.isAuthenticated },
        { title: 'Login', to: '/login', show: !this.isAuthenticated },
        { title: 'Logout', to: '/logout', show: this.isAuthenticated },
      ];
    },
    isAuthenticated() {
      return this.$store.getters['auth/isAuthenticated'];
    },
    userName() {
      return this.$store.getters['auth/username'];
    }
  },
}
</script>

<style>

</style>