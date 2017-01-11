import { FETCH_VALUATIONS } from '../actions/index';

const INITIAL_STATE = { valuations: [] };

export default function( state = INITIAL_STATE, action ) {

	switch( action.type ) {
		case FETCH_VALUATIONS:
			return { ...state, valuations: action.payload.data };
		default:
			return state;
	}
}