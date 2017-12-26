import * as React from "react";
import { UserInterface } from './Interfaces/UserInterface';

export class User extends React.Component<UserInterface, {}> {

    constructor(props: any) {
        super(props);

        this.state = {
            age: ""
        }
    }

    render() {
        return (
            <div>
                <p>Hello from { this.props.username } { this.props.email } !</p>
            </div>
        );
    }
}
