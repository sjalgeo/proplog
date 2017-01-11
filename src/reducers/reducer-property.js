import { FETCH_PROPERTIES } from '../actions/index';

const INITIAL_STATE = [];

export default function( state = INITIAL_STATE, action ) {

	switch( action.type ) {
		case FETCH_PROPERTIES:
			return action.payload.data;
		default:
			return state;
	}
}