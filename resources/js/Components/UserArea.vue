<template>
    <nav class="userBar">
        <ul class="navBar__link">
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'profile' }">Profile</router-link>
            </li>
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'logout' }">Logout</router-link>
            </li>
            <li v-if="!isLoggedIn">
                <router-link :to="{ name: 'sign-in' }">Sign In</router-link>
            </li>
            <li v-if="!isLoggedIn">
                <router-link :to="{ name: 'sign-up' }">Sign Up</router-link>
            </li>
        </ul>
    </nav>
</template>
Ò
<script>
export default {
    name: 'navbar',
    computed: {
        isLoggedIn: function () {
            return this.$store.getters.isLoggedIn
        }
    },
}
</script>
