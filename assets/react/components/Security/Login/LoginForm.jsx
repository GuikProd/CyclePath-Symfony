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
                <LoginInput
                    inputType={"password"}
                    inputId={"password"}
                    inputName={"_password"}
                    labelName={"Password"}
                />
                <button type="submit">Login</button>
            </form>
        );
    }
}
