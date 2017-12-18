import React, { Component } from 'react';

import { LoginInput } from "./LoginInput";

export class LoginForm extends Component
{
    render () {
        return (
            <form action="login" method="post">
                <LoginInput
                    inputType={"text"}
                    inputId={"username"}
                    inputName={"_username"}
                    labelName={"Username"}
                />
                <div className="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <LoginInput
                        inputType={"password"}
                        inputId={"password"}
                        inputName={"_password"}
                        labelName={"Password"}
                    />
                </div>
                <button className={"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"} type="submit">Login</button>
            </form>
        );
    }
}
