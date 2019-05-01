import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Navigation from '../Pageparts/Navigation';
import Head from '../Pageparts/Head';


export default class Index extends Component {
    render() {
        return (
            <div>
                <Head/>
                <Navigation/>
            </div>
        );
    }
}