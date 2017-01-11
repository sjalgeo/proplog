import React, { Component } from 'react';
import { Link } from 'react-router';

const freshpress_pages = [
	{
		title: 'Dashboard',
		route: '/admin/dashboard'
	},
	{
		title: 'Portfolio',
		route: '/admin/portfolio'
	},
	{
		title: 'Property',
		route: '/admin/property'
	},
	{
		title: 'Add Property',
		route: '/admin/property/add'
	}
];

export default () => {
	var links = freshpress_pages.map( function (item, key) {
		return <Link key={key} to={item.route} className="button">
			{item.title}
		</Link>
	});

	return (<div>
		{links}
	</div>);
}