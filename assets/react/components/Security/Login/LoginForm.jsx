import React, { Component } from 'react';

import { LoginInput } from "./LoginInput";

export class LoginForm extends Component
{
    render () {
        return (
            <form action="/login" method="post">
                <LoginInput />
            </form>
        );
    }
}
