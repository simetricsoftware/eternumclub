import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        tickets: [],
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
        setAmount(state, amount) {
            state.amount = amount
        }
    }
})
