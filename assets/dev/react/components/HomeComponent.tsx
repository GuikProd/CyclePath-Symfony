import * as React from "react";
import { HomeComponentInterface } from './Interfaces/HomeComponentInterface';

export interface HomeComponentsProps { }

export class HomeComponent extends React.Component<HomeComponentsProps, {}> implements HomeComponentInterface
{
    render() {
        return (
            <div>
                <p>Hello World from React !</p>
            </div>
        );
    }
}
