import React, { Component } from 'react';

export class Path extends Component {

    constructor(props) {
        super(props);

        this.state = {
            id: this.props.path.id,
            startingDate: this.props.path.startingDate,
            endingDate: this.props.path.endingDate,
            duration: this.props.path.duration
        }
    }

    render () {
        return (
            <div>
                <p>{ this.props.path.duration }</p>
                <p>{ this.props.path.startingDate }</p>
                <p>{ this.props.path.endingDate }</p>
                <p>{ this.props.path.distance }</p>
            </div>
        );
    }
}
