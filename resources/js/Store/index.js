import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import API from '../Services/api'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        status: '',
        user: localStorage.getItem('user'),
        token: localStorage.getItem('token'),
        message: '',
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, data) {

            const token = data.access_token
            const userDataSerialised = JSON.stringify(data.user);

            localStorage.setItem('token', token)
            localStorage.setItem('user', userDataSerialised);
            axios.defaults.headers.common['Authorization'] = "Bearer " + data.access_token

            state.status = 'success'
            state.user = userDataSerialised
            state.token = data.access_token
        },
        auth_error(state) {
            localStorage.removeItem('user')
            localStorage.removeItem('token')
            delete axios.defaults.headers.common['Authorization']

            state.status = 'error'
        },
        sign_out(state) {
            localStorage.removeItem('user')
            localStorage.removeItem('token')
            delete axios.defaults.headers.common['Authorization']

            state.status = ''
            state.user = ''
            state.token = ''
        },
        message_new(state, message) {
            state.message = message
        },
        message_clear(state) {
            state.message = ''
        }
    },
    actions: {
        signIn({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                API.signIn(user)
                    .then(resp => {
                        commit('auth_success', resp.data)
                        commit('message_new', 'Sign In successfully!')
                        setTimeout(() => commit('message_clear'), 3000)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        commit('message_new', err)
                        setTimeout(() => commit('message_clear'), 3000)
                        reject(err)
                    })
            })
        },
        signUp({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                API.signUp(user)
                    .then(resp => {
                        commit('message_new', resp.message)
                        setTimeout(() => commit('message_clear'), 3000)
                        resolve(resp)
                    })
                    .catch((err) => {
                        commit('message_new', 'Error: Something wrong! Call to site admin!')
                        setTimeout(() => commit('message_clear'), 3000)
                        reject(err)
                    })
            })
        },
        saveProfile({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                API.patchProfile(user.id, user)
                    .then(resp => {
                        commit('auth_success', resp.data)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        signOut({commit}) {
            return new Promise((resolve, reject) => {
                API.signOut()
                    .then(resp => {
                        commit('sign_out')
                        commit('message_new', 'Sign Out successfully!')
                        setTimeout(() => commit('message_clear'), 3000)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('message_new', 'Error when sign out!')
                        setTimeout(() => commit('message_clear'), 3000)
                        reject(err)
                    })
            })
        }
    },
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
