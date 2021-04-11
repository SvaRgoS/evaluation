<template>
    <div class="auth">
        <h4>Profile</h4>
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
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'profile',
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            is_admin: null
        }
    },
    methods: {
        register: function () {
            let data = {
                name: this.name,
                email: this.email,
                password: this.password,
                is_admin: this.is_admin
            }
            this.$store.dispatch('register', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>
