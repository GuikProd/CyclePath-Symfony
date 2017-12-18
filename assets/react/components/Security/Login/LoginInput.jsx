import React, { Component } from 'react';
import LoginCheck from "./LoginCheck";

export class LoginInput extends Component {

    constructor(props) {
        super(props);

        this.state = {
            check: false,
            inputValue: "",
            csrfProtection: this.props.csrfProtection,
            lastUsername: ""
        }
    }

    onBlurHandler(inputValue) {
        this.triggerCheck(true);
        this.updateInputValue(inputValue);
    }

    triggerCheck(check) {
        this.setState({
            check: check
        });
    }

    updateInputValue(inputValue) {
        this.setState({
            inputValue: inputValue.target.value
        });
    }

    render () {

        if (this.state.check) {
            return (
                <div className={"mdl-textfield mdl-js-textfield mdl-textfield--floating-label"}>
                    <label className={"mdl-textfield__label"} htmlFor={ this.props.inputId }> { this.props.labelName } </label>
                    <input
                        className={"mdl-textfield__input"}
                        type={ this.props.inputType }
                        id={ this.props.inputId }
                        name={ this.props.inputName }
                        onBlur={ (inputValue) => this.onBlurHandler(inputValue) }
                    />
                    <LoginCheck
                        check={ this.state.check }
                        inputKey={ this.props.inputId }
                        inputValue={ this.state.inputValue }
                    />
                </div>
            );
        } else if (this.props.lastUsername) {
            return (
                <div className={"mdl-textfield mdl-js-textfield mdl-textfield--floating-label"}>
                    <label className={"mdl-textfield__label"} htmlFor={ this.props.inputId }> { this.props.labelName } </label>
                    <input
                        className={"mdl-textfield__input"}
                        type={ this.props.inputType }
                        id={ this.props.inputId }
                        name={ this.props.inputName }
                        defaultValue={ this.props.lastUsername }
                        onBlur={ (inputValue) => this.onBlurHandler(inputValue) }
                    />
                    <LoginCheck
                        check={ this.state.check }
                        inputKey={ this.props.inputId }
                        inputValue={ this.state.inputValue }
                    />
                </div>
            );
        } else if (this.props.inputId === "token") {
            return (
                <div className={"mdl-textfield mdl-js-textfield mdl-textfield--floating-label"}>
                    <input
                        type={ this.props.inputType }
                        value={ this.props.csrfProtection }
                    />
                 </div>
            );
        }

        return (
            <div>
                <label htmlFor={ this.props.inputId }> { this.props.labelName } </label>
                <input type={ this.props.inputType } id={ this.props.inputId } name={ this.props.inputName } onBlur={ (inputValue) => this.onBlurHandler(inputValue) } />
            </div>
        );
    }
}
