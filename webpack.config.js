var webpack = require('webpack');

const REMOTE_SCRIPTS_DIR = '/Users/sjalgeo/websites/proplog.dev/wp-content/plugins/proplog/scripts';

// var plugins = [
// 	new webpack.DefinePlugin({
// 		'process.env': {
// 			'NODE_ENV': JSON.stringify('production')
// 		}
// 	})
// ];
var plugins = [];

module.exports = {
	entry: [
		'./src/index.js'
	],
	devtool: process.env.WEBPACK_DEVTOOL || 'cheap-module-source-map',
	output: {
		path: REMOTE_SCRIPTS_DIR,
		filename: "admin.min.js"
	},
	plugins: plugins,
	module: {
		loaders: [
			{
				// test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel',
				query: {
					presets: ['react','es2015', "stage-1"]
				}
			}
		]
	}
};