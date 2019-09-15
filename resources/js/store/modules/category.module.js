
const state = {
    categoryList: [],
}

const getters = {
    all(state) {
        return state.categoryList;
    }
}

const mutations = {
    all(state, data) {
        state.categoryList = data;
    }

}

const actions = {
    getAll({commit}) {
        axios.get('/api/category')
            .then(res => {
                commit('all', res.data.data)
            })
            .catch(error => console.log(error));
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}