import Vue from 'vue';
import Vuex from 'vuex';
import 'es6-promise/auto';
import createPersistedState from 'vuex-persistedstate';
import Auth from './modules/auth.module';
import Category from './modules/category.module';
import Question from './modules/question.module';

Vue.use(Vuex);

const store = new Vuex.Store({
    plugins: [createPersistedState()],
    modules: {
        auth: Auth,
        category: Category,
        question: Question,
    }
});

export default store