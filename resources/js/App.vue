<template>
    <div class="app">
        <div class="topBar">
            <Navbar></Navbar>
            <UserArea></UserArea>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
import './Styles/app.scss'

import UserArea from "./Components/UserArea";
import Navbar from "./Components/Navbar";

export default {
    name: 'app',
    components: {
        Navbar,
        UserArea
    }
}
</script>
