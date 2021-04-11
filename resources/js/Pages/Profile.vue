<template>
    <div class="auth">
        <h3>Profile</h3>
        <form @submit.prevent="save">
            <label for="name">Name</label>
            <div>
                <input id="name" v-model="name" autofocus required type="text">
            </div>
            <label>Permissions</label>
            <div>
                <input id="read" v-model="permissions" type="checkbox" value="read">
                <label for="read">Read</label>
                <input id="write" v-model="permissions" type="checkbox" value="write">
                <label for="write">Write</label>
                <input id="remove" v-model="permissions" type="checkbox" value="remove">
                <label for="remove">Remove</label>
            </div>
            <div>
                <button type="submit">Save</button>
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
