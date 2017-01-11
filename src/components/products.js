import React, { Component } from 'react';
import { connect } from 'react-redux';
import { fetchProductGroups } from '../actions/index';


class Products extends Component {

	componentWillMount() {
		this.props.fetchProductGroups();
	}

	renderGroups() {
		return this.props.product_groups.map(( group ) => {
			return <li key={group.id}>{group.title}</li>;
		});
	}

	render() {

		return (<div>
			<h3>Groups</h3>
			<ul>
				{this.renderGroups()}
			</ul>
		</div>);
	}
}

function mapStateToProps(state) {
	return { product_groups: state.product_groups.all };
}

export default connect( mapStateToProps, { fetchProductGroups } )(Products);