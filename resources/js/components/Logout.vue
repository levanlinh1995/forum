<template>
  
</template>

<script>
export default {
    created() {
        this.$store.dispatch('auth/userLogout');
    }
}
</script>