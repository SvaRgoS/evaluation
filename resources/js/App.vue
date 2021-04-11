<template>
    <div class="app">
        <div class="topBar">
            <Navbar></Navbar>
            <UserArea></UserArea>
        </div>
        <router-view></router-view>
        <Notify></Notify>
    </div>
</template>

<script>
import './Styles/app.scss'

import UserArea from "./Components/UserArea";
import Navbar from "./Components/Navbar";
import Notify from "./Components/Notify";

export default {
    name: 'app',
    components: {
        Navbar,
        UserArea,
        Notify
    }
}
</script>
