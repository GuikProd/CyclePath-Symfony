import React, { Component } from 'react';
import gql from "graphql-tag";
import { withApollo } from "react-apollo/index";

class LoginCheck extends Component {

    constructor(props) {
        super(props);

        this.state = {
            inputValue: "",
            violation: false,
            visible: false,
            check: false
        }
    }

    componentDidMount() {
        this.triggerCheck(this.props.check);
        this.triggerDisplay(false);
        this.triggerViolation(true);
        this.checkUserInput(this.props.inputKey, this.props.inputValue);
    }


    componentWillReceiveProps(nextProps) {
        this.triggerCheck(true);
        this.triggerViolation(false);
        this.triggerDisplay(false);
        this.checkUserInput(nextProps.inputKey, nextProps.value);
    }

    triggerViolation(violation) {
        this.setState({
            violation: violation
        });
    }

    triggerDisplay(display) {
        this.setState({
            visible: display
        });
    }

    triggerCheck(check) {
        this.setState({
            check: check
        });
    }

    setInputState(inputValue) {
        this.setState({
            inputValue: inputValue
        });
    }

    checkUserInput(inputId, inputValue) {
        switch (inputId) {
            case 'username':
                this.props.client.query({
                    query: gql`
                        query checkUserInput($username: String) {
                            user(username: $username) {
                                username
                                active
                            }
                        }`,
                    variables: {
                        username: inputValue
                    }
                }).then(response => {
                    switch (response.loading) {
                        case false:
                            if (response.data.user === null || response.data.user[0] === null) {
                                this.triggerViolation(false);
                                this.triggerDisplay(false);
                            } else if (response.data.user[0].username === inputValue) {
                                this.triggerViolation(true);
                                this.triggerDisplay(true);
                                this.setInputState(inputValue);
                            } else {
                                this.triggerViolation(false);
                                this.triggerDisplay(false);
                            }
                            break;
                        default:
                            this.triggerViolation(false);
                            break;
                    }
                });
                break;
            case 'password':
                this.triggerCheck(false);
                this.triggerViolation(false);
                this.triggerDisplay(false);
                break;
            default:
                this.triggerDisplay(false);
                break;
        }
    }

    render () {

        if (this.state.visible) {
            return (
                <div>
                    <p>The user { this.state.inputValue } exist !</p>
                </div>
            );
        }

        return null;
    }
}

export default withApollo(LoginCheck)
