import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        amount: 0
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
