<template>
    <b-row>
        <b-col></b-col>
        <b-col cols="6">
            <main class="inner cover pt-5" role="main">
                <h1>Sign Up</h1>
                <b-form class="login" @submit.prevent="register">

                    <b-form-group
                        label="Name:"
                        label-for="name"
                    >
                        <b-form-input
                            id="name-2"
                            v-model="name"
                            placeholder="Enter a name"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

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

                    <b-form-group
                        label="Confirm password:"
                        label-for="input-passwd"
                    >
                        <b-form-input
                            id="input-passwd"
                            v-model="password_confirmation"
                            placeholder="Confirm password"
                            required
                            type="password"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        label="Select the role:"
                        label-for="input-role"
                    >
                        <b-form-select id="input-role"
                                       v-model="role_id"
                                       :options="options"
                                       class="mt-3"
                                       size="sm">
                        </b-form-select>
                    </b-form-group>

                    <hr/>
                    <b-button type="reset" variant="warning" @click.prevent="$router.go(-1)">Cancel</b-button>
                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
            </main>
        </b-col>
        <b-col></b-col>
    </b-row>
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
            role_id: "1",
            options: {
                1: 'Reader',
                2: 'Writer',
                3: 'Redactor'
            },
        }
    },
    methods: {
        register: function () {
            let data = {
                name: this.name,
                email: this.email,
                role_id: this.role_id,
                password: this.password,
                permissions: this.permissions
            }
            this.$store.dispatch('signUp', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>
