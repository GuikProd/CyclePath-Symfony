<template>
    <div>
        <p>Hello {{ user[0].email }}</p>
    </div>
</template>

<script>
    import { USER_BY_USERNAME } from "../../../GraphQL/Query/User/UserByUsername";

    export default {
        name: "user",
        data () {
            return {
                username: "",
                user: []
            }
        },
        mounted () {
            this.$set(this, 'username', dataLayout.user);
        },
        apollo: {
            user: {
                query: USER_BY_USERNAME,
                variables: {
                    username: dataLayout.user
                }
            }
        }
    }
</script>

<style scoped>

</style>
