<template>
    <div id="app">
        <p>{{ message }}</p>
    </div>
</template>

<script>
    export default {
        name: 'Main',
        data () {
            return {
                message: "",
            }
        },
        mounted () {
            this.$set(this, 'message', dataLayout.message);
        }
    }
</script>

<style scoped>

</style>
