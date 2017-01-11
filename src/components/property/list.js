import React from 'react';
import { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';
import { fetchProperties } from '../../actions/index';

class PropertyList extends Component {

	componentWillMount() {
		this.props.fetchProperties();
	}

	render() {

		if ( undefined === this.props.property ) {
			return <h3>Loading your data... Please wait...</h3>;
		}

		const { property } = this.props;

		console.log(this.props.property);

		const property_list = property.map( function( property ){

			return <tr key={property.id}>
				<td>{property.id}</td>
				<td>{property.name}</td>
				{/*<td><button className="btn grey" onClick={this.onDeleteClick.bind(this, store.id)}>Delete</button></td>*/}
				{/*<td><button className="btn yellow">Apply Domain</button></td>*/}
			</tr>;
		}, this);

		return <div>
			<div className="table-responsive">
				<table className="table font-medium">
					<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Actions...</th>
					</tr>
					</thead>
					<tbody>
					{property_list}
					</tbody>
				</table>
			</div>

			<br />
			<br />

			<Link to="admin/property/add">Add Property</Link>

			{/*<Feedback />*/}

			{/*<DeletePostModal />*/}
		</div>
	}
}

function mapStateToProps(state) {

	console.log(state.property);

	return { property: state.property };
}

export default connect(mapStateToProps, { fetchProperties })(PropertyList);