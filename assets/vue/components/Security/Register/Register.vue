<template>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <form name="register" v-bind:action="path" method="post">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="register_username" class="mdl-textfield__label">
                    Username
                </label>
                <input
                        type="text"
                        name="register[username]"
                        id="register_username"
                        class="mdl-textfield__input"
                        v-model.lazy="username"
                        v-on:blur="checkEntry(username)"
                        required
                />
                <p class="has-error" v-if="violation['usernameViolation']"> Oops, there's an error, this value already exist !</p>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="register_email" class="mdl-textfield__label">
                    Email
                </label>
                <input
                        type="email"
                        name="register[email]"
                        id="register_email"
                        class="mdl-textfield__input"
                        v-model.lazy="email"
                        v-on:blur="checkEntry(email)"
                        required
                />
                <p class="has-error" v-if="violation['emailViolation']"> Oops, there's an error, this value already exist !</p>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="register_plainPassword" class="mdl-textfield__label">
                    Password
                </label>
                <input
                        type="password"
                        name="register[plainPassword]"
                        id="register_plainPassword"
                        class="mdl-textfield__input"
                        v-model.lazy="plainPassword"
                        required
                />
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input
                        type="hidden"
                        name="register[_token]"
                        id="register__token"
                        v-bind:value="csrfProtection"
                />
            </div>
            <br />
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" v-if="submit">
                Create an account !
            </button>
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
                path: "",
                csrfProtection: "",
                violation: [
                    usernameViolation => false,
                    emailViolation => false
                ],
                submit: true
            }
        },
        methods: {
            checkEntry(entry) {
                switch (entry) {
                    case this.username:
                        this.$apollo.provider.defaultClient.query({
                            query: USER_BY_USERNAME,
                            variables: {
                                username: this.username
                            }
                        }).then(response => {
                            if (response.data.user === null || response.data.user[0] === null) {
                                this.triggerViolation('usernameViolation', false);
                                this.allowSubmit(true);
                            } else if (response.data.user[0].username === this.username) {
                                this.triggerViolation('usernameViolation', true);
                                this.allowSubmit(false);
                            } else {
                                this.triggerViolation('usernameViolation', false);
                                this.allowSubmit(true);
                            }
                        });
                        break;
                    case this.email:
                        this.$apollo.provider.defaultClient.query({
                            query: USER_BY_EMAIL,
                            variables: {
                                email: this.email
                            }
                        }).then(response => {
                            console.log(response.data);
                            if (response.data.user === null || response.data.user[0] === null) {
                                this.triggerViolation('emailViolation', false);
                                this.allowSubmit(true);
                            } else if (response.data.user[0].email === this.email) {
                                this.triggerViolation('emailViolation', true);
                                this.allowSubmit(false);
                            } else {
                                this.triggerViolation('emailViolation', false);
                                this.allowSubmit(true);
                            }
                        });
                        break;
                    default:
                        break;
                }
            },
            triggerViolation(key, violation) {
                this.violation[key] = violation;
            },
            allowSubmit(block) {
                this.submit = block;
            }
        },
        mounted () {
            this.$set(this, 'path', dataLayout.path);
            this.$set(this, 'csrfProtection', dataLayout.csrfToken);
        }
    }
</script>

<style scoped>

</style>
