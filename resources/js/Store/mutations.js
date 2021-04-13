import axios from "axios";

export const mutations = {
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
}
