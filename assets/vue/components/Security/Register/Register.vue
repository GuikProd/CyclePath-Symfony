<template>
    <div class="register_home mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <form name="register" method="post">
            <label for="register[username]">Username</label>
            <input type="text" name="register_username" id="register[username]" v-model.lazy="username" v-on:blur="checkEntry(username)" required />
            <p class="has-error" v-if="violation"> Oups, there's an error, this value already exist !</p>
            <label for="register[email]">Email</label>
            <input type="email" name="register_email" id="register[email]" v-model.lazy="email" v-on:blur="checkEntry(email)" required />
            <p class="has-error" v-if="violation"> Oups, there's an error, this value already exist !</p>
            <label for="register[plainPassword]">Password</label>
            <input type="password" name="register_plainPassword" id="register[plainPassword]" v-model.lazy="plainPassword" required />
            <button type="submit" v-if="submit">Create an account !</button>
        </form>
    </div>
</template>

<script>
    import { USER_BY_USERNAME } from "../../../../GraphQL/Query/User/UserByUsername";
    import { USER_BY_EMAIL } from "../../../../GraphQL/Query/User/UserByEmail";

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
                } else if (entry === this.email) {
                    this.$apollo.provider.defaultClient.query({
                        query: USER_BY_EMAIL,
                        variables: {
                            email: this.email
                        }
                    }).then(response => {
                        console.log(response.data);
                        if (response.data.user === null || response.data.user[0] === null) {
                            this.triggerViolation(false);
                            this.allowSubmit(true);
                        } else if (response.data.user[0].email === this.email) {
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
