import React from 'react';
import { Component } from 'react';
import Stats from './chart';
import { connect } from 'react-redux';
import { fetchValuations } from '../actions/index';
// import Welcome from './welcome';
import Nav from './nav';
// import Products from './products';

class Portfolio extends Component {

	componentWillMount() {
		this.props.fetchValuations();
	}

	render() {

		if ( undefined === this.props.valuations ) {
			return <h3>Loading your data... Please wait...</h3>;
		}

		const { valuations } = this.props.valuations;

		return <div>
			<Nav />
			<Stats data={valuations} />
			<h1>This is the Portfolio Page</h1>
		</div>
	}
}

function mapStateToProps(state) {
	return { valuations: state.valuations };
}

export default connect(mapStateToProps, { fetchValuations })(Portfolio);