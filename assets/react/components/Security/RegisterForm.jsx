import React, { Component } from 'react';
import RegisterInput from "./RegisterInput";

export class RegisterForm extends Component
{
    render () {
        return (
            <form name="register" method="post">
                <RegisterInput
                    inputId={"register_username"}
                    inputLabel={"Username"}
                    inputName={"register[username]"}
                    inputType={"text"}
                    required={"required"}
                    valueKey={"username"} />
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
                <button type="submit">Register</button>
            </form>
        );
    }
}
