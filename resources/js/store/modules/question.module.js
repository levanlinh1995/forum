
const state = {
    questionList: [],
}

const getters = {
    all(state) {
        return state.questionList;
    }
}

const mutations = {
    all(state, data) {
        state.questionList = data;
    }

}

const actions = {
    getAll({commit}) {
        axios.get('/api/question')
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