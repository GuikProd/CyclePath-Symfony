<template>
    <div id="navigationBar">
        <p>{{ navigationTitle }}</p>
    </div>
</template>

<script>
    export default {
        name: 'NavigationBar',
        data () {
            return {
                navigationTitle: ""
            }
        },
        mounted () {
            this.$set(this, 'navigationTitle', dataLayout.navigationTitle);
        }
    }
</script>

<style scoped>

</style>

