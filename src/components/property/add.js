import React, { Component } from 'react';
import { Field, reduxForm } from 'redux-form';

class AddPropertyForm extends Component {

	handleSubmit( values ) {
		console.log('handle');
		console.log(values);
	}

	render() {

		// const { handleSubmit } = this.props;
		return (
		  <form onSubmit={this.handleSubmit}>
			  <div>
				  <label htmlFor="property_name">Give your store a name...</label>
				  <br />
				  <Field name="property_name" component="input" type="text"/>
			  </div>
			  <button type="submit">Submit</button>
		  </form>
		);
	}
}

// Decorate the form component
AddPropertyForm = reduxForm({
	form: 'add-property' // a unique name for this form
})(AddPropertyForm);

export default AddPropertyForm;