import API from "../Services/api";

export const actions = {
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
                commit('sign_out')
                setTimeout(() => commit('message_clear'), 3000)
                reject(err)
            })
    })
}
}
