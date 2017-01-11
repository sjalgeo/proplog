import React from 'react';
import { Route, IndexRoute } from 'react-router';
import Portfolio from './components/portfolio';
import AddProperty from './components/property/add';
import PropertyList from './components/property/list';

import App from './components/app';

export default (
  <Route path="admin">
	  <IndexRoute component={App} />
	  <Route path="portfolio" component={Portfolio} />
	  <Route path="property/add" component={AddProperty} />
	  <Route path="property/" component={PropertyList} />




	  {/*<Route path="stats" component={Stats} />*/}
	  {/*<Route path="products" component={Products} />*/}
  </Route>

);