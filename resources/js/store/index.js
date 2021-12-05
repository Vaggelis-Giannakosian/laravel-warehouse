import { createStore } from "vuex"

const store = createStore({
    state:{
        flashMessage: null
    },
    actions: {
        flashMessage({commit}, message) {
            commit('updateFlashMessage', message)
        },
    },
    mutations: {
        updateFlashMessage(state, message) {
            state.flashMessage = message
        },
    }
})

export default store
