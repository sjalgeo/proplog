import axios from 'axios';

export const FETCH_VALUATIONS = 'FETCH_VALUATIONS';

export function fetchValuations() {

	const ROOT_URL = 'http://proplog.dev/wp-json/proplog/v1/valuations';
	const request = axios.get( ROOT_URL );

	return {
		type: FETCH_VALUATIONS,
		payload: request
	};
}


export const FETCH_PROPERTIES = 'FETCH_PROPERTIES';

export function fetchProperties() {

	const ROOT_URL = 'http://proplog.dev/wp-json/proplog/v1/property';
	const request = axios.get( ROOT_URL );

	return {
		type: FETCH_PROPERTIES,
		payload: request
	};
}