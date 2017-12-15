import React, { Component } from 'react';
import RegisterCheck from "./RegisterCheck";

export default class RegisterInput extends Component {

    constructor(props) {
        super(props);

        this.state = {
            inputId: props.inputId,
            required: props.required,
            inputName: props.inputName,
            inputType: props.inputType,
            inputLabel: props.inputLabel
        }
    }

    render () {
        return (
            <div>
                <label htmlFor={ this.state.inputId }> { this.state.inputLabel } </label>
                <input type={ this.state.inputType } name={ this.state.inputName } id={ this.state.inputId } required={ this.state.required }/>
                <RegisterCheck inputValue={"Hello"}/>
            </div>
        );
    }
}
