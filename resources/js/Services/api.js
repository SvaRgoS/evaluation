import axios from "axios";

const auth = function (payloadFunction) {
    return axios.get('/sanctum/csrf-cookie')
        .then(response => payloadFunction(response))
        .catch(reason => console.error("Can't preform auth request", reason));
}

const apiHost = process.env.API_HOST
    ? process.env.API_HOST
    : 'http://localhost/api/'

const API = {
    signIn: function (payload) {
        return axios({
            url: `${apiHost}/sign-in`,
            data: payload,
            method: 'POST'
        })
    },
    signUp: function (payload) {
        return axios({
            url: `${apiHost}/sign-up`,
            data: payload,
            method: 'POST'
        })
    },
    getProfile: function (payload) {
        return auth(response =>
            axios({
                url: `${apiHost}/profile`,
                method: 'GET'
            })
        )
    },
    putProfile: function (id, payload) {
        return auth(auth_response =>
            axios({
                url: `${apiHost}/profile/${id}`,
                data: payload, method: 'PUT'
            })
        )
    }
}

export default API;
