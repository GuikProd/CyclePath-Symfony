import React from "react";
import renderer from 'react-test-renderer';
import RegisterForm from "../../components/Security/Register/RegisterForm";

test('It should render correctly', () => {
    const component = renderer.create(
        <RegisterForm />,
    );
    let tree = component.toJSON();
});
