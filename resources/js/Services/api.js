
const auth = function () {
    return axios.get('/sanctum/csrf-cookie');
}

auth().get(response => {

    // Login...
});
