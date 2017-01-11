import React from 'react';
import { AreaChart } from 'react-d3-components';

class Chart extends React.Component {

	render() {

		console.log(this.props.data);

		if ( this.props.data.length === 0 ) {
			return null;
		}

		const equity = this.props.data.map( function(record) {
			return {
				x: new Date(record.created*1000),
				y: record.equity
			};
		} );

		const valuations = this.props.data.map( function(record) {
			return {
				x: new Date(record.created*1000),
				y: record.value - record.equity
			};
		} );

		const data = [
			{
				label: 'Equity',
				values: equity
			},
			{
				label: 'Valuation',
				values: valuations
			}
		];

		const xScale = d3.time.scale().domain([new Date(2015, 11, 11), new Date(2017, 1, 1)]).range([0, 1200]);

		return <AreaChart
		  data={data}
		  width={1200}
		  height={600}
		  xScale={xScale}

		  yAxis={{label: "Portfolio Valuation"}}
		  yOrientation='left' // if you do not provide right default left orientation for yAxis will be used
		  margin={{top: 10, bottom: 50, left: 75, right: 10}}/>
	}
}

export default Chart;