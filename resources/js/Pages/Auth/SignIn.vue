<template>
    <b-row>
        <b-col></b-col>
        <b-col cols="6">
            <main class="inner cover pt-5" role="main">
                <h1>Sign in</h1>
                <b-form class="login" @submit.prevent="login">
                    <b-form-group
                        description="We'll never share your email with anyone else."
                        label="Email address:"
                        label-for="input-1"
                    >
                        <b-form-input
                            id="input-1"
                            v-model="email"
                            placeholder="Enter email"
                            required
                            type="email"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        description="Enter yous password."
                        label="Password:"
                        label-for="input-2"
                    >
                        <b-form-input
                            id="input-2"
                            v-model="password"
                            placeholder="Enter password"
                            required
                            type="password"
                        ></b-form-input>
                    </b-form-group>
                    <hr/>
                    <b-button type="reset" variant="danger">Reset</b-button>
                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
            </main>
        </b-col>
        <b-col></b-col>
    </b-row>
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
