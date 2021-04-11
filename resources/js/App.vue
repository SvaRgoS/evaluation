<template>
    <b-container fluid>
        <b-row>
            <b-col cols="12">
                <b-navbar toggleable="lg" type="dark" variant="info">
                    <b-navbar-brand href="#">{{ username }}</b-navbar-brand>
                    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                    <Navbar></Navbar>
                </b-navbar>
            </b-col>
        </b-row>
        <router-view></router-view>
        <Notify></Notify>
    </b-container>
</template>

<script>

import './Styles/app.scss'

import Navbar from "./Components/Navbar";
import Notify from "./Components/Notify";
import axios from "axios";


export default {
    name: 'app',
    components: {
        Navbar,
        Notify
    },
    computed: {
        isLoggedIn: function () {
            return this.$store.getters.isLoggedIn
        },
        username: function () {
            const user = this.$store.getters.currentUser
            return (user && user.name) ? user.name : 'Guest'
        }
    },
    mounted() {
        if( this.isLoggedIn) {
            axios.defaults.headers.common['Authorization'] = "Bearer " + this.$store.state.token
        }
    }
}
</script>
