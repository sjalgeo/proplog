import React from 'react';
import { Component } from 'react';
import Nav from './nav';

export default class App extends Component {

	render() {

		const page = this.props.location.query.page;

		return <div>
			<Nav />
			This is the main app page
		</div>
	}
}