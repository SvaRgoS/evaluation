<template>
    <div class="auth">
        <h3>Sign Up</h3>
        <form @submit.prevent="register">
            <label for="name">Name</label>
            <div>
                <input id="name" v-model="name" autofocus required type="text">
            </div>
            <label for="email">E-Mail Address</label>
            <div>
                <input id="email" v-model="email" required type="email">
            </div>

            <label for="password">Password</label>
            <div>
                <input id="password" v-model="password" required type="password">
            </div>
            <label for="password-confirm">Confirm Password</label>
            <div>
                <input id="password-confirm" v-model="password_confirmation" required type="password">
            </div>
            <label>Permissions</label>
            <div>
                <input type="checkbox" id="read" value="read" v-model="permission">
                <label for="read">Read</label>
                <input type="checkbox" id="write" value="write" v-model="permission">
                <label for="write">Write</label>
                <input type="checkbox" id="remove" value="remove" v-model="permission">
                <label for="remove">Remove</label>
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'register',
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            permission: []
        }
    },
    methods: {
        register: function () {
            let data = {
                name: this.name,
                email: this.email,
                password: this.password,
                permission: this.permission
            }
            this.$store.dispatch('register', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>
