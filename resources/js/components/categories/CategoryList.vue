<template>
  <v-container>
  <v-btn color="primary" @click="openCreateDialog">Create new</v-btn>
  <create-dialog-form
    v-if="createDialog"
    :dialog="createDialog"
    @onCloseDialog="closeCreateDialog"
    @onCreateCategory="createCategory($event)"
    ></create-dialog-form>
  <edit-dialog-form
    v-if="updateDialog"
    :dialog="updateDialog"
    :updatedItem="updatedItem"
    @onCloseDialog="closeEditDialog"
    @onEditCategory="editCategory($event)"
    ></edit-dialog-form>

  <v-card class="mt-2">
	<v-toolbar dark>
		<v-toolbar-title>
			Categories
		</v-toolbar-title>
	</v-toolbar>

	<v-card-text>
		<v-list>
			<v-list-item v-for="(category, index) in categoryList" :key="category.id">
                    <v-list-item-icon>
                        <v-btn icon=""><v-icon color="green darken-2" @click="openEditDialog(index, category)">mdi-pencil</v-icon></v-btn>
                        <v-btn icon=""><v-icon color="red darken-2" @click="deleteCategory(index, category)">mdi-delete</v-icon></v-btn>
                    </v-list-item-icon>
				<v-list-item-content>
					{{ category.name }}
				</v-list-item-content>
			</v-list-item>
		</v-list>
	</v-card-text>
  </v-card>

  <v-snackbar
      top
      v-model="snackbar.show"
      :timeout="snackbar.timeout"
      >
      {{ snackbar.message }}
      <v-btn
          color="blue"
          text
          @click="snackbar.show = false"
      >
          Close
      </v-btn>
  </v-snackbar>
  </v-container>
</template>

<script>
import CreateDialogForm from './CreateDialogForm';
import EditDialogForm from './EditDialogForm';

export default {
    components: {
        CreateDialogForm,
        EditDialogForm,
    },
    data() {
      return {
              createDialog: false,
              updateDialog: false,
              updatedItem: null,
              snackbar: {
                  show: false,
                  message: '',
                  timeout: 3000,
              },
		}
  },
  computed: {
    categoryList() {
      return this.$store.getters['category/all'];
    }
  },
	created() {
		this.$store.dispatch('category/getAll');
    },
    methods: {
      openCreateDialog() {
        this.createDialog = true;
      },
      openEditDialog(index, category) {
        this.updatedItem = category;
        this.updateDialog = true;
        
      },
      closeCreateDialog() {
        this.createDialog = false;
      },
      closeEditDialog() {
        this.updateDialog = false;
      },
      deleteCategory(index, category) {
        axios.delete(`/api/category/${category.slug}`)
          .then(res => {
            this.categoryList.splice(index, 1);
            this.showSnackbar('Delete successfully.');
          })
          .catch(error => console.log(error));
      },
      createCategory(data) {
        this.categoryList.unshift(data.data);
        this.showSnackbar(data.message);
      },
      editCategory(data) {
        let category = data.data;
        let message = data.message;

        let index = this.categoryList.findIndex(function(element) {
          return element.id == category.id;
        });
        
        this.categoryList[index] = category;
        this.showSnackbar(message);
      },
      showSnackbar(message) {
        this.snackbar.show = true;
        this.snackbar.message = message;
      }
      
    }
}
</script>

<style>

</style>