import AppStorage from '../../helpers/AppStograge';
import route from '../../router/route';
import LaravelEcho from '../../helpers/LaravelEcho';

const state = {
    token: null,
    userId: null,
    username: null,
}

const getters = {
    token(state) {
        return state.token;
    },
    userId(state) {
        return state.userId;
    },
    isAuthenticated(state) {
        return state.token ? true : false;
    },
    username(state) {
        return state.username;
    }
}

const mutations = {
    storeUser(state, userData) {
        state.token = userData.token;
        state.userId = userData.userId;
        state.username = userData.username;
    },
    logout(state) {
        state.token = null;
        state.userId = null;
        state.username = null;
    },
}

const actions = {
    userLogin({ commit }, userData) {
        axios.post('/api/auth/login', userData)
            .then(res => {
                const access_token = res.data.access_token;
                const username = res.data.user;
                const userId = res.data.userId;
                commit('storeUser', {
                    token: access_token,
                    username: username,
                    userId: userId,
                });
                AppStorage.store(access_token);

                window.Echo = LaravelEcho.init(access_token);

                route.push({ name: 'forum' });
            })
            .catch(error => console.log(error));
    },
    userLogout({ commit }) {
        axios.post('/api/auth/logout')
        .then(res => {
            AppStorage.clear();
            commit('logout');
            route.push({ name: 'login' });
        })
        .catch(error => console.log(error));
    }
}



const moduleAuth = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}

export default moduleAuth