import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/index';

import Login from '../components/Login';
import Logout from '../components/Logout';
import Signup from '../components/Signup';
import Forum from '../components/forum/Forum';
import QuestionDetail from '../components/questions/QuestionDetail';
import CreateQuestion from '../components/questions/CreateQuestion';
import EditQuestion from '../components/questions/EditQuestion';
import CategoryList from '../components/categories/CategoryList';

Vue.use(VueRouter);

const routes = [
    { path: '/login',
      component: Login,
      name: 'login',
      beforeEnter: (to, from, next) => {
        if (store.getters['auth/isAuthenticated']) {
            next({ name: 'forum' });
        }

        next();
      } 
    },
    { path: '/logout',
      component: Logout,
      name: 'logout',
      beforeEnter: (to, from, next) => {
        if (!store.getters['auth/isAuthenticated']) {
            next({ name: 'login' });
        }

        next();
      }
    },
    { path: '/signup',
      component: Signup,
      name: 'signup',
      beforeEnter: (to, from, next) => {
        if (store.getters['auth/isAuthenticated']) {
            next({ name: 'forum' });
        }

        next();
      }
    },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/question/:slug', component: QuestionDetail, name: 'question-detail' },
    { path: '/question/:slug/edit',
      component: EditQuestion,
      name: 'question-edit',
      beforeEnter: (to, from, next) => {
        if (!store.getters['auth/isAuthenticated']) {
            next({ name: 'login' });
        }

        next();
      }
    },
    { path: '/ask',
      component: CreateQuestion,
      name: 'create-question',
      beforeEnter: (to, from, next) => {
        if (!store.getters['auth/isAuthenticated']) {
            next({ name: 'login' });
        }

        next();
      }
    },
    { path: '/categories', component: CategoryList, name: 'categories' },


];

export default new VueRouter({
    mode: 'history',
    routes
}); 