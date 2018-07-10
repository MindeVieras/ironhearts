
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import superagent from 'superagent';

import ReactQueryParams from 'react-query-params';
import scrollToComponent from 'react-scroll-to-component';

import Title from './_components/Title';
import Subtitle from './_components/Subtitle';
import Map from './_components/Map';
import Places from './_components/Places';
import Search from './_components/Search';

class App extends ReactQueryParams {

	constructor() {
		super();
		this.state = {
      map: null,
      address_msg: '',
			centres: [],
			markers: [],
      center: {
        lat: 51.454,
        lng: -2.587918
      },
      zoom: 10,
      radius: 2000 //high radius so it takes all UK
		}

	}

	componentDidMount() {

    // if params has LAT and LNG set center
    if (this.queryParams.lat && this.queryParams.lng) {
      this.setState({
        center: {
          lat: parseFloat(this.queryParams.lat),
          lng: parseFloat(this.queryParams.lng)
        }
      });
    }

    this.makeApiCall(this.state.center.lat, this.state.center.lng, this.state.radius);
	}

  makeApiCall(lat, lng, radius) {
    // const baseUrl = 'http://local.imperialhearing.com';
    const baseUrl = '';
    let url = baseUrl+'/wp-json/api/get-centres/'+lat+'/'+lng+'/'+radius;
    superagent
    .get(url)
    .query(null)
    .set('Accept', 'text/json')
    .end((error, response) => {
      let centresObj = response.body;
      console.log(centresObj);
      if (centresObj.ack == 'err') return;
      let centresArr = Object.keys(centresObj).map(function (key) { return centresObj[key]; });
      let markersArr = Object.keys(centresObj).map(function (key) {
        let markers = {
          position: {
            lat: parseFloat(centresObj[key].location.lat),
            lng: parseFloat(centresObj[key].location.lng)
          },
          showInfo: false,
          infoContent: centresObj[key]
        }
        return markers;
      });
      this.setState({
        centres: centresArr,
        markers: markersArr,
        currentCentre: {
          title: response.body[0].name,
          content: response.body[0].content
        }
      });
    });
  }

	handleMapMounted(map){
    this._map=map;
    if (this.state.map != null)
      return
    this.setState({
      map: map
    })
  }

  handleMarkerClick(targetMarker) {
    this.setState({
      markers: this.state.markers.map(marker => {
        if (marker.position.lat === targetMarker.position.lat && marker.position.lng === targetMarker.position.lng) {
          return {
            ...marker,
            showInfo: true
          };
        } else {
          return {
            ...marker,
            showInfo: false
          }
        }
        return marker;
      }),
    });
  }

  handleMarkerClose(targetMarker) {
    this.setState({
      markers: this.state.markers.map(marker => {
        if (marker.position.lat === targetMarker.position.lat && marker.position.lng === targetMarker.position.lng) {
          return {
            ...marker,
            showInfo: false,
          };
        }
        return marker;
      }),
    });
  }

  onPlaceClick(place) {
    this.setState({
      //center: place,
      markers: this.state.markers.map(marker => {
        if (marker.position.lat === place.location.lat && marker.position.lng === place.location.lng) {
          return {
            ...marker,
            showInfo: true
          };
        } else {
          return {
            ...marker,
            showInfo: false
          }
        }
        return marker;
      }),
      currentCentre: {
        title: place.name,
        content: place.content
      }
    });
  }

  handlePlacesChanged(place) {
    if (place.geometry) {
      scrollToComponent(this.Map, { offset: 0, align: 'top', duration: 500, ease:'inCirc'});
      this.setState({
        address_msg: '',
        center: {
          lat: place.geometry.location.lat(),
          lng: place.geometry.location.lng()
        }
      });

      this.makeApiCall(place.geometry.location.lat(), place.geometry.location.lng(), this.state.radius);

    } else {
      this.setState({
        address_msg: 'Please select location from a list'
      });
    }
  }

	render() {
		const rootElement = document.getElementById('postcode-finder');
   	let title = rootElement.getAttribute('data-title');
   	let content = rootElement.getAttribute('data-content');
   	
    return (

      <div>
        <div className="top">
          <div className="head">
            <Title title={title} />
            <Subtitle subtitle={content} />
          </div>
          <div className="search-input">
            <div id="postcode-finder-form">
            <div className="message">{ this.state.address_msg }</div>
              <Search
                onPlacesChanged={(place) => this.handlePlacesChanged(place)}
              />
            </div>
          </div>
        </div>
        <div className="postcode-finder-map-wrapper" ref={(map) => { this.Map = map; }}>
          <Map
            center={this.state.center}
            zoom={this.state.zoom}
            markers={this.state.markers}
            containerElement={<div style={{height:100+'%'}} />}
            mapElement={<div style={{height:100+'%'}} />}
            onMapMounted={(map) => this.handleMapMounted(map)}
            onMarkerClick={(marker) => this.handleMarkerClick(marker)}
            onMarkerClose={(marker) => this.handleMarkerClose(marker)}
            onProfileClick={(profile) => this.onProfileClick(profile)}
          />
        </div>
        <div className="results">
          <div className="results-title">Results</div>
          <div className="results-subtitle">Here are your nearest centres based on your search. Click on more information for details of the centre.</div>
            <Places
              centres={this.state.centres}
              onPlaceClick={(place) => this.onPlaceClick(place)}
            />
        </div>
      </div>

    );
  }

}


ReactDOM.render(<App />, document.getElementById('postcode-finder'));