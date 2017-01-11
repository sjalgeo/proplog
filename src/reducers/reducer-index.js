import { combineReducers } from 'redux';
import ValuationsReducer from './reducer-valuations';
import PropertyReducer from './reducer-property';
// import { reducer as formReducer } from 'redux-form';

const rootReducer = combineReducers({
	valuations: ValuationsReducer,
	property: PropertyReducer
});

export default rootReducer;