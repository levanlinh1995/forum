<template>
  <v-container>
    <v-form @submit.prevent="login">
        <v-text-field
            v-model="form.email"
            label="E-mail*"
            type="email"
            required
        ></v-text-field>
        <v-text-field
            v-model="form.password"
            label="Password*"
            required
            type="password"
        ></v-text-field>
        <v-btn
            color="success"
            class="mr-4"
            type="submit"
        >
            Submit
        </v-btn>
        <router-link :to="{ name: 'signup' }" tag="button">
          <v-btn
            class="mr-4"
            type="submit"
        >
            signup
        </v-btn>
        </router-link>
    </v-form>
  </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('auth/userLogin', this.form);
        }
    }
}
</script>

<style>

</style>