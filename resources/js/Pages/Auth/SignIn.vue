<template>
    <div class="auth">
        <h3>Sign in</h3>
        <form class="login" @submit.prevent="login">
            <label>Email</label>
            <input v-model="email" placeholder="Name" required type="email"/>
            <label>Password</label>
            <input v-model="password" placeholder="Password" required type="password"/>
            <hr/>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'login',
    data() {
        return {
            email: "",
            password: ""
        }
    },
    methods: {
        login: function () {
            let email = this.email
            let password = this.password
            this.$store.dispatch('signIn', {email, password})
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>
