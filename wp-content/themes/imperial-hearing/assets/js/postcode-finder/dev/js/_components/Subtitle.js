
import React, { Component } from 'react';
import PropTypes from 'prop-types';

class Subtitle extends Component {
	render() {
		return (
			<div className="subtitle">{this.props.subtitle}</div>

		);
	}
}

Subtitle.propTypes = {
  subtitle: PropTypes.string.isRequired
}

export default Subtitle;