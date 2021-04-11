import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import API from '../Services/api'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        status: '',
        user : localStorage.getItem('user'),
    },
    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, user){
            const userDataSerialised = JSON.stringify(user);
            localStorage.setItem('user', userDataSerialised);
            state.status = 'success'
            state.user = user
        },
        auth_error(state){
            state.status = 'error'
            localStorage.removeItem('user')
        },
        sign_out(state){
            localStorage.removeItem('user')
            state.status = ''
            state.user = ''
        },
    },
    actions: {
        signIn({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                API.signIn(user)
                    .then(resp => {
                        commit('auth_success', resp.data)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        reject(err)
                    })
            })
        },
        signUp({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                API.signUp(user)
                    .then(resp => {
                        commit('auth_success', user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })
        },
        saveProfile({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                console.log('usss', user);
                API.patchProfile(user.id, user)
                    .then(resp => {
                        commit('auth_success', user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })
        },
        signOut({commit}){
            return new Promise((resolve, reject) => {
                commit('sign_out')
                resolve()
            })
        }
    },
    getters : {
        isLoggedIn: (state, getters)  => !!getters.currentUser,
        authStatus: state => state.status,
        currentUser: state => {
            try {
                console.log("CU", JSON.parse(state.user))
                return JSON.parse(state.user)
            }catch(e) {
                console.error('Error user parsing user data', e)
                return ''
            }
        }
    }
})
