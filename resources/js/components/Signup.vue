<template>
  <v-container>
    <v-form @submit.prevent="signup">
        <v-text-field
            v-model="form.name"
            label="Name*"
            type="text"
            required
        ></v-text-field>
        <span v-if="errors.name" class="red--text">{{ errors.name[0] }}</span>
        <v-text-field
            v-model="form.email"
            label="E-mail*"
            type="email"
            required
        ></v-text-field>
        <span v-if="errors.email" class="red--text">{{ errors.email[0] }}</span>
        <v-text-field
            v-model="form.password"
            label="Password*"
            required
            type="password"
        ></v-text-field>
        <span v-if="errors.password" class="red--text">{{ errors.password[0] }}</span>
        <v-text-field
            v-model="form.password_confirmation"
            label="Re-password*"
            required
            type="password"
        ></v-text-field>
        <v-progress-circular
            v-if="isSubmited"
            indeterminate
            color="primary"
        ></v-progress-circular>
        <v-btn
            color="success"
            class="mr-4"
            type="submit"
            :disabled="isSubmited"
        >
            Submit
        </v-btn>

        <router-link :to="{ name: 'login' }" tag="button">
          <v-btn
            class="mr-4"
            type="submit"
        >
            Login
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: {},
            isSubmited: false,
        }
    },
    created() {
    },
    methods: {
        signup() {
            this.isSubmited = true;
            axios.post('/api/auth/signup', this.form)
            .then(res => {
                User.responseAfterLogin(res);
                this.$router.push({ name: 'forum' });
            })
            .catch(error => {
                if (error.response) {
                    this.errors = error.response.data.errors;
                }
            })
            .finally(() => this.isSubmited = false);
        }
    }
}
</script>

<style>

</style>