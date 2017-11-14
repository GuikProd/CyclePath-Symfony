import * as React from "react";

import { HomeComponentInterface } from './Interfaces/HomeComponentInterface';
import { HomeComponentProps } from '../Props/HomeComponentProps';

export class HomeComponent extends React.Component<HomeComponentProps, any> implements HomeComponentInterface
{
    constructor(props: HomeComponentProps) {
        super(props);

        this.state = {
            text: this.props.text
        }
    }

    render() {
        return (
            <div>
                <p>{ this.state.text }</p>
            </div>
        );
    }
}
