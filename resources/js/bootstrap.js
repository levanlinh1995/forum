window._ = require('lodash');
import AppStorage from './helpers/AppStograge';
import store from './store/index';
import route from './router/route';
import LaravelEcho from './helpers/LaravelEcho';


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.axios.interceptors.request.use(function(config) {
    const token = store.getters['auth/token'];
    if(token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, function(err) {
    return Promise.reject(err);
});

window.axios.interceptors.response.use(function (response) {
    return response;
  }, function (error) {
    if (error.response.status == 401) {
        store.commit('auth/logout');
        AppStorage.clear();
        route.push({ name: 'login' });
    }
    return Promise.reject(error)
  })

  let JWTToken = AppStorage.getToken();
  window.Echo = LaravelEcho.init(JWTToken);