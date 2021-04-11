<template>
    <nav class="navBar">
        <ul class="navBar__link">
            <li>
                <router-link :to="{ name: 'home' }">Home</router-link>
            </li>
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'contacts' }">Contacts</router-link>
            </li>
        </ul>
    </nav>
</template>

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
