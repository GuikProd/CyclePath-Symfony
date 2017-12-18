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
            inputLabel: props.inputLabel,
            valueKey: props.valueKey,
            inputValue: "",
            csrfProtection: this.props.csrfProtection,
            check: false
        }
    }

    updateInputValue(value) {
        this.setState({
            inputValue: value.target.value
        });

        this.triggerViolationCheck(true);
    }

    triggerViolationCheck(violationCheck) {
        this.setState({
            check: violationCheck
        });
    }

    render () {

        if (this.state.check) {
            return (
                <div className={"mdl-textfield mdl-js-textfield"}>
                    <label className={"mdl-textfield__label"}
                           htmlFor={this.state.inputId}> {this.state.inputLabel} </label>
                    <input className={"mdl-textfield__input"}
                           type={this.state.inputType}
                           name={this.state.inputName}
                           id={this.state.inputId}
                           required={this.state.required}
                           onBlur={elementValue => this.updateInputValue(elementValue)}
                    />
                    <RegisterCheck
                        check={this.state.check}
                        value={this.state.inputValue}
                        inputKey={this.state.inputId}
                    />
                </div>
            );
        } else if (this.props.csrfProtection) {
            return (
                <div className={"mdl-textfield mdl-js-textfield"}>
                    <label className={"mdl-textfield__label"}
                           htmlFor={this.state.inputId}> { this.state.inputLabel } </label>
                    <input type={ this.state.inputType }
                           name={ this.state.inputName }
                           id={ this.state.inputId }
                           required={this.state.required }
                           value={ this.props.csrfProtection }
                    />
                </div>
            );
        } else {
            return (
                <div>
                    <label htmlFor={ this.state.inputId }> { this.state.inputLabel } </label>
                    <input
                        type={ this.state.inputType }
                        name={ this.state.inputName }
                        id={ this.state.inputId }
                        required={ this.state.required }
                        onBlur={ elementValue => this.updateInputValue(elementValue) }
                    />
                </div>
            );
        }
    }
}
