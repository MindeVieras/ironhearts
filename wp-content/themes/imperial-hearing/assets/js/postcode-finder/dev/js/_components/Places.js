import React, { Component } from 'react';

class Places extends Component {

	render() {

		const list = this.props.centres.slice(0, 3).map((centre, i) => {
			
			let addressString = centre.address;
    	let addressArray = addressString.split(",");
    	let address = addressArray.map((row, index) => {
    		return <li key={index}>{row.trim()}</li>
    	});

			return <li key={i} className="results-place">
							<div className="inner">
								<div className="name">{centre.name}</div>
								<ul className="address">{address}</ul>
								<div className="bottom">
                  <div className="info-list">
  									<a href={'mailto:'+centre.email} className="link"><b>E:</b> {centre.email}</a>
  									<a href={'tel:'+centre.phone} className="link"><b>T:</b> {centre.phone}</a>
                    {centre.website &&
                      <a href={centre.website} className="link" target="_blank"><b>W:</b> {centre.website}</a>
                    }
                  </div>
									<a href={centre.url} className="more-info btn">More information</a>
								</div>
							</div>
						</li>
		})

		return (
		  <div className="places-wrapper">
				<ul className="centres-list">{list}</ul>
			</div>
		)
	}
}

export default Places