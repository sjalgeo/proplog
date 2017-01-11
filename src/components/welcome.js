import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';

class Welcome extends Component {

	render() {
		return <div>
			<h3>Welcome to the FreshPress Plugin, let's get started.</h3>


		</div>;
	}
}

function mapStateToProps(state) {
	return { book: state.activeBook };
}

export default connect(mapStateToProps)(Welcome);