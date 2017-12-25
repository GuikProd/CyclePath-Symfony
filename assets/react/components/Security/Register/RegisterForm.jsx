import React, { Component } from 'react';
import RegisterInput from "./RegisterInput";

export default class RegisterForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            csrf: dataLayout.token
        }
    }

    render () {
        return (
            <form name="register" method="post">
                <RegisterInput
                    inputId={"register_username"}
                    inputLabel={"Username"}
                    inputName={"register[username]"}
                    inputType={"text"}
                    required={"required"}
                    valueKey={"username"}
                />
                <RegisterInput
                    inputId={"register_email"}
                    inputLabel={"Email"}
                    inputName={"register[email]"}
                    inputType={"email"}
                    required={"required"}
                    valueKey={"email"} />
                <RegisterInput
                    inputId={"register_plainPassword"}
                    inputLabel={"Password"}
                    inputName={"register[plainPassword]"}
                    inputType={"password"}
                    required={"required"}
                    valueKey={"password"} />
                <RegisterInput
                    inputId={"register_token"}
                    inputName={"register[_token]"}
                    inputType={"hidden"}
                    csrfProtection={ this.state.csrf }
                />
                <button className={"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"} type="submit" id={"registerBtn"}>
                    Register
                </button>
            </form>
        );
    }
}
