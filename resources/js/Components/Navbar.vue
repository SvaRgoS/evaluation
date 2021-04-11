<template>
    <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <b-nav-item href="#">
                <router-link class="text-white" :to="{ name: 'home' }">Home</router-link>
            </b-nav-item>
            <b-nav-item href="#">
                <router-link class="text-white" :to="{ name: 'contacts' }">Contacts</router-link>
            </b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
            <template  v-if="isLoggedIn">
                <b-nav-item href="#" right>
                    <router-link class="text-white" :to="{ name: 'profile' }">Profile</router-link>
                </b-nav-item>
                <b-nav-item href="#" >
                    <a href="#sign-out" class="text-white" @click.prevent="signOut">Sign Out</a>
                </b-nav-item>
            </template>
            <template v-else class="float-md-right">
                <b-nav-item href="#" >
                    <router-link class="text-white" :to="{ name: 'sign-in' }">Sign In</router-link>
                </b-nav-item>
                <b-nav-item href="#" >
                    <router-link class="text-white" :to="{ name: 'sign-up' }">Sign Up</router-link>
                </b-nav-item>
            </template>

        </b-navbar-nav>
    </b-collapse>
</template>

<script>
export default {
    name: 'navbar',
    computed: {
        isLoggedIn: function () {
            return this.$store.getters.isLoggedIn
        },
        username: function () {
            const user = this.$store.getters.currentUser
            return user.name ? user.name : 'Guest'
        }
    },
    methods: {
        signOut: function () {
            this.$store.dispatch('signOut')
        }
    },
}
</script>
