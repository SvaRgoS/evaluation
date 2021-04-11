<template>
    <div class="home">
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: 'home',
    computed: {
        ...mapState({
            count: state => state.count
        }),
    }
}
</script>

