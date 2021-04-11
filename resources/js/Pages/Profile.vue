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
                        label="Check permissions:"
                        label-for="input-permissions"
                    >
                        <b-form-checkbox-group
                            id="checkbox-group-2"
                            v-model="permissions"
                            name="flavour-2"
                        >
                            <b-form-checkbox value="read">Read</b-form-checkbox>
                            <b-form-checkbox value="write">Write</b-form-checkbox>
                            <b-form-checkbox value="remove">Remove</b-form-checkbox>
                        </b-form-checkbox-group>
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
            permissions: []
        }
    },
    computed: {
        currentUser: function () {
            return this.$store.getters.currentUser
        }
    },
    methods: {
        save: function () {
            let data = {
                id: this.currentUser.id,
                name: this.name,
                permissions: this.permissions
            }

            this.$store.dispatch('saveProfile', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    },
    mounted() {
        this.name = this.currentUser.name;
        this.permissions = this.currentUser.permissions;
    }
}
</script>
