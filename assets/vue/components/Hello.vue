<template>
    <div id="app">
        <p>{{ msg }}</p>
        <button v-on:click="greeting">Clicker !</button>
    </div>
</template>

<script>
    export default {
        name: 'Hello',
        data () {
            return {
                msg: 'Hello World from Vue !'
            }
        },
        methods: {
            greeting () {
                this.msg = "Hello World !"
            }
        }
    }
</script>
