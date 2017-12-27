<template>
    <div>
        <p>Hello from Vue {{ user }}</p>
        <ul v-for="pt in path" :key="pt.id">
            <li>{{ pt.id }} {{ pt.startingDate }}</li>
        </ul>
    </div>
</template>

<script>
    import { ALL_PATHS } from "../../../GraphQL/Query/Path/Paths";

    export default {
        name: "Home",
        data () {
            return {
                path: [],
                user: ""
            }
        },
        mounted () {
            this.$set(this, 'user', dataLayout.user)
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
