import React, { Component } from 'react';

import { LoginInput } from "./LoginInput";

export class LoginForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            csrfProtection: dataLayout.csrfProtection,
            lastUsername: dataLayout.lastUsername,
            locale: dataLayout.locale
        }
    }

    render () {
        return (
            <form action={ '/' + this.state.locale } method="post">
                <LoginInput
                    inputType={"text"}
                    inputId={"username"}
                    inputName={"_username"}
                    labelName={"Username"}
                    lastUsername={ this.state.lastUsername }
                />
                <div className="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <LoginInput
                        inputType={"password"}
                        inputId={"password"}
                        inputName={"_password"}
                        labelName={"Password"}
                    />
                </div>
                <LoginInput
                    inputType={"hidden"}
                    inputId={"token"}
                    inputName={"_token"}
                    csrfProtection={ this.state.csrfProtection }
                />
                <button className={"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"} type="submit">Login</button>
            </form>
        );
    }
}
