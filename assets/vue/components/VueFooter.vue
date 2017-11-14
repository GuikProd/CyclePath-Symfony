<template>
    <div id="vueFooter">
        <p>{{ title }}</p>
    </div>
</template>

<script>
    export default {
        name: 'VueFooter',
        data () {
            return {
                footerTitle: ""
            }
        },
        props: {
            title: {
                type: String,
                required: true
            }
        },
        mounted () {
            this.$set(this, 'footerTitle', dataLayout.footerTitle);
        }
    }
</script>

<style scoped>

</style>

