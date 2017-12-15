import React, { Component } from 'react';
import RegisterCheck from "./RegisterCheck";

export default class RegisterInput extends Component
{
    constructor(props) {
        super(props);

        this.state = {
            inputId: props.inputId,
            required: props.required,
            inputName: props.inputName,
            inputType: props.inputType,
            inputLabel: props.inputLabel,
            valueKey: props.valueKey,
            inputValue: ""
        }
    }

    updateInputValue(value) {
        this.setState({
            inputValue: value.target.value
        });
    }

    render () {

        if (this.state.violation) {
            return (
                <div>
                    <label htmlFor={ this.state.inputId }> { this.state.inputLabel } </label>
                    <input type={ this.state.inputType } name={ this.state.inputName } id={ this.state.inputId } required={ this.state.required } value={ this.state.inputValue } onChange={ elementValue => this.updateInputValue(elementValue) } />
                    <RegisterCheck value={ this.state.inputValue } />
                </div>
            );
        } else {
            return (
                <div>
                    <label htmlFor={ this.state.inputId }> { this.state.inputLabel } </label>
                    <input type={ this.state.inputType } name={ this.state.inputName } id={ this.state.inputId } required={ this.state.required } value={ this.state.inputValue } onChange={ elementValue => this.updateInputValue(elementValue) } />
                    <RegisterCheck  value={ this.state.inputValue } />
                </div>
            );
        }
    }
}
