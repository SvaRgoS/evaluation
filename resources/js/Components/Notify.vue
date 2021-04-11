<template>
    <div class="notify">
        {{ message }}
    </div>
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
