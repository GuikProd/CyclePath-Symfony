<template>
    <div class="register_home mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <form name="register" method="post">
            <label for="register[username]">Username</label>
            <input type="text" name="register_username" id="register[username]" required v-model="username" v-on:blur="checkEntry(username)" />
            <p class="has-error" v-if="violation"> Oups, there's an error, this value already exist !</p>
            <label for="register[email]">Email</label>
            <input type="email" name="register_email" id="register[email]" required v-model="email" v-on:blur="checkEntry(email)" />
            <p class="has-error" v-if="violation"> Oups, there's an error, this value already exist !</p>
            <label for="register[plainPassword]">Password</label>
            <input type="password" name="register_plainPassword" id="register[plainPassword]" required v-model="plainPassword" />
            <button type="submit" v-if="submit">Create an account !</button>
        </form>
    </div>
</template>

<script>
    import { USER_BY_USERNAME } from "../../../../GraphQL/Query/User/UserByUsername";

    export default {
        name: "register",
        data () {
            return {
                username: "",
                email: "",
                plainPassword: "",
                violation: false,
                submit: true
            }
        },
        methods: {
            checkEntry(entry) {
                if (entry === this.username) {
                    this.$apollo.provider.defaultClient.query({
                        query: USER_BY_USERNAME,
                        variables: {
                            username: this.username
                        }
                    }).then(response => {
                        if (response.data.user === null || response.data.user[0] === null) {
                            this.triggerViolation(false);
                            this.allowSubmit(true);
                        } else if (response.data.user[0].username === this.username) {
                            this.triggerViolation(true);
                            this.allowSubmit(false);
                        } else {
                            this.triggerViolation(false);
                            this.allowSubmit(true);
                        }
                    })
                }
            },
            triggerViolation(violation) {
                this.violation = violation;
            },
            allowSubmit(block) {
                this.submit = block;
            }
        }
    }
</script>

<style scoped>

</style>
