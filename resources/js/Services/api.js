import axios from "axios";

const apiHost = process.env.API_HOST
    ? process.env.API_HOST
    : 'http://localhost/api/'

const API = {
    signIn: function (payload) {
        return axios({
            url: `${apiHost}auth/sign-in`,
            data: payload,
            method: 'POST'
        })
    },
    signUp: function (payload) {
        return axios({
            url: `${apiHost}auth/sign-up`,
            data: payload,
            method: 'POST'
        })
    },
    signOut: function () {
        return axios({
            url: `${apiHost}auth/sign-out`,
            method: 'GET'
        })
    },
    getProfile: function (payload) {
        return axios({
            url: `${apiHost}auth/profile`,
            method: 'GET'
        })
    },
    patchProfile: function (id, payload) {
        return axios({
            url: `${apiHost}auth/profile/${id}`,
            data: payload,
            method: 'PATCH'
        })
    },
    getContacts: function () {
        return axios({
            url: `${apiHost}contact`,
            method: 'GET'
        })
    },
    getContact: function (id) {
        return axios({
            url: `${apiHost}contact/${id}`,
            method: 'GET'
        })
    },
    postContact: function (payload) {
        return axios({
            url: `${apiHost}contact`,
            data: payload,
            method: 'POST'
        })
    },
    patchContact: function (id, payload) {
        return axios({
            url: `${apiHost}contact/${id}`,
            data: payload,
            method: 'PATCH'
        })
    },
    removeContact: function (id) {
        return axios({
            url: `${apiHost}contact/${id}`,
            method: 'DELETE'
        })
    }
}

export default API;
