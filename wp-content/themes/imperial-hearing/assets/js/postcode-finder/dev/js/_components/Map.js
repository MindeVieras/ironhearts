import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { withGoogleMap, GoogleMap, InfoWindow, Marker } from  'react-google-maps';
import mapStyles from './mapStyles.json';

class Map extends Component {

	render() {
		const markers = this.props.markers.map((row, i) => {
			const marker = {
				position: {
					lat: row.position.lat,
					lng: row.position.lng
				}
			}

			return <Marker
							{...marker}
							key={i}
							onClick={() => this.props.onMarkerClick(marker)}
							onMouseOver={() => this.props.onMarkerClick(marker)}
							icon="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjU2LDBDMTY3LjY0MSwwLDk2LDcxLjYyNSw5NiwxNjBjMCwyNC43NSw1LjYyNSw0OC4yMTksMTUuNjcyLDY5LjEyNUMxMTIuMjM0LDIzMC4zMTMsMjU2LDUxMiwyNTYsNTEybDE0Mi41OTQtMjc5LjM3NSAgIEM0MDkuNzE5LDIxMC44NDQsNDE2LDE4Ni4xNTYsNDE2LDE2MEM0MTYsNzEuNjI1LDM0NC4zNzUsMCwyNTYsMHogTTI1NiwyNTZjLTUzLjAxNiwwLTk2LTQzLTk2LTk2czQyLjk4NC05Niw5Ni05NiAgIGM1MywwLDk2LDQzLDk2LDk2UzMwOSwyNTYsMjU2LDI1NnoiIGZpbGw9IiM0MzI1NjUiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K"
						>
							{row.showInfo && (
			          <InfoWindow onCloseClick={() => this.props.onMarkerClose(marker)}>
			          	<div>
				            <div className="left">
				            	<div className="name">{row.infoContent.name}</div>
				            	<div className="address">{row.infoContent.address}</div>
				            </div>
				            <div className="right">
				            	<div className="distance">{row.infoContent.location.distance} miles away</div>
				            	<div className="view-profile"><strong><a href={row.infoContent.url}>View profile</a></strong></div>
				            </div>
			            </div>
			          </InfoWindow>
			        )}
						</Marker>
		});

		return (
			<GoogleMap
				ref={this.props.onMapMounted}
		    zoom={this.props.zoom}
		    center={this.props.center}
		    options={{
		    	streetViewControl: false,
		    	mapTypeControl: false,
		    	scrollwheel: false,
		    	styles: mapStyles
		    }}
		  >
		    { markers }
		  </GoogleMap>
		);
	}
}

Map.propTypes = {
  center: PropTypes.object.isRequired,
  zoom: PropTypes.number.isRequired,
  markers: PropTypes.array.isRequired,
  onMapMounted: PropTypes.func.isRequired,
  onMarkerClick: PropTypes.func,
  onMarkerClose: PropTypes.func
}

export default withGoogleMap(Map)