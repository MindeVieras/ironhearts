
import React, { Component } from 'react';
import PropTypes from 'prop-types';

import Autocomplete from 'react-google-autocomplete';

class Search extends Component {
  
	render() {

		return (
			<div>
				<Autocomplete
					onPlaceSelected={(place) => {
						this.props.onPlacesChanged(place);
					}}
					placeholder="Search by postcode or city"
					id="postcode-finder-input"
					types={['geocode']}
					componentRestrictions={{country:'UK'}}
				/>

    	</div>
		)
	}
}

Search.propTypes = {
  onPlacesChanged: PropTypes.func.isRequired
}

export default Search