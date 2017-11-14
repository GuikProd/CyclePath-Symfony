<template>
    <div id="app">
        <navigation-bar></navigation-bar>
            <p>{{ message }}</p>
            <p>{{ homeMessage }}</p>
        <vue-footer :title="message"></vue-footer>
    </div>
</template>

<script>

    import NavigationBar from "./NavigationBar.vue";
    import VueFooter from "./VueFooter.vue"

    export default {
        name: 'Main',
        data () {
            return {
                message: "",
                homeMessage: ""
            }
        },
        mounted () {
            this.$set(this, 'message', dataLayout.message);
        },
        components: {
            VueFooter,
            NavigationBar
        }
    }
</script>

<style scoped>

</style>
