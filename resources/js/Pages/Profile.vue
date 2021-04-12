<template>
    <b-row>
        <b-col></b-col>
        <b-col cols="6">
            <main class="inner cover pt-5" role="main">
                <h1>Profile</h1>
                <b-form class="login" @submit.prevent="save">

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
                    <b-button type="reset" @click.prevent="$router.go(-1)" variant="warning">Cancel</b-button>
                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
            </main>
        </b-col>
        <b-col></b-col>
    </b-row>
</template>

<script>
export default {
    name: 'profile',
    data() {
        return {
            name: "",
            role_id: "",
            options: {
                1: 'Reader',
                2: 'Writer',
                3: 'Redactor'
            },
        }
    },
    computed: {
        currentUser: function () {
            return this.$store.getters.currentUser
        },
    },
    methods: {
        save: function () {
            let data = {
                id: this.currentUser.id,
                name: this.name,
                role_id: this.role_id
            }

            this.$store.dispatch('saveProfile', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    },
    mounted() {
        this.name = this.currentUser.name;
        this.role_id = this.currentUser.role_id;
    }
}
</script>
