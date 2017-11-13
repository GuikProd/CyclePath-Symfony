<template>
    <div id="footer">
        <p>{{ footerTitle }}</p>
    </div>
</template>

<script>
    export default {
        name: 'Footer',
        data () {
            return {
                footerTitle: ""
            }
        },
        mounted () {
            this.$set(this, 'footerTitle', dataLayout.footerTitle);
        }
    }
</script>

<style scoped>

</style>

