<template>
    <div id="paths">
        <ul>
            <li v-for="pth in path" :key="pth.id">
                <p>{{ pth.startingDate }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    import { ALL_PATHS } from './../graphql/queries';

    export default {
        name: 'Paths',
        data () {
            return {
                paths: []
            }
        },
        apollo: {
            path: {
                query: ALL_PATHS
            }
        }
    }
</script>

<style scoped>

</style>
