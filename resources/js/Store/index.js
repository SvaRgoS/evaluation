import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import { actions } from "./actions";
import { mutations } from "./mutations";

export default new Vuex.Store({
    state: {
        status: '',
        user: localStorage.getItem('user'),
        token: localStorage.getItem('token'),
        message: '',
    },
    mutations,
    actions,
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
        currentUser: state => {
            try {
                return JSON.parse(state.user)
            } catch (e) {
                console.error('Error user parsing user data', e)
                return ''
            }
        }
    }
})
