<template>
<v-card class="mt-2">
	<v-toolbar dark>
		<v-toolbar-title>
			Categories
		</v-toolbar-title>
	</v-toolbar> 

	<v-card-text>
		<v-list>
			<v-list-item v-for="category in categoryList" :key="category.id">
				<v-list-item-content>
					{{ category.name }}
				</v-list-item-content>
			</v-list-item>
		</v-list>
	</v-card-text>
</v-card>
</template>

<script>
export default {
	computed: {
		categoryList() {
			return this.$store.getters['category/all'];
		}
	},
	created() {
		this.$store.dispatch('category/getAll');
	}
}
</script>

<style>

</style>