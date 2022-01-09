import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        impacts: [],
        events: [],
    },
    mutations: {
        add(state) {
            state.count++
        },
    },
    actions: {}
})

export default store;
