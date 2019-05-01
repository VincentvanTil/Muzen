import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {BrowserRouter as Router, Link, Route} from 'react-router-dom';
import Home from './components/Pages/Home';
import Navigation from './components/Pageparts/Navigation';


export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <Router>
                    <div>
                        <Route path="/" exact component={Home}/>
                        <Route path="/blog" exact component={Navigation}/>
                    </div>
                </Router>
            </div>
        );
    }
}
if (document.getElementById('root')) {
    ReactDOM.render(<Index />, document.getElementById('root'));
}