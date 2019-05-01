import React, { Component } from 'react';
import {BrowserRouter as Router, Link, Route} from 'react-router-dom';

export default class Header extends Component {
	render() {
		return (
			<Router>
			<div>
			<Link to="/">Home</Link>
			<Link to="/">About us</Link>

			<Route path="/" Component={Home} />
			<Route path="/about" Component={About} />
			</div>
			</Router>
		);
	}
}
