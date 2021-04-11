<template>
    <b-alert class="message" variant="success" :show="message.length>0">{{ message }}</b-alert>
</template>

<script>
export default {
    name: 'notify',
    computed: {
        message: function () {
            return this.$store.state.message
        }
    },
}
</script>
<style>
.message{
    position: absolute;
    bottom:10px;
    padding:10px;
    text-align: center;
}
</style>
