function initMap(){v_map.initMap();};
var v_map = {
	//doi tuong view. quan ly map
	"geocoder" : null,
	"map":null,
	"directionsService" :null,
    "directionsDisplay" :null,
	"initMap": function initMap() {
	    this.map = new google.maps.Map(document.getElementById('map_canvas'), {
	        center: {lat: 21.0245, lng: 105.84117},
	        zoom: 8
	    });
	    this.geocoder = new google.maps.Geocoder();
	    this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer
        this.directionsDisplay.setMap(v_map.map);
		},
	"getadress" : function getadress(element,latLng){
		this.geocoder.geocode({'latLng': latLng},
			function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						element.val(results[0].formatted_address);
					} else {
						element.val("No results");
					}
				} else {
					if(status==OVER_QUERY_LIMIT)
            			window.alert('Ban nhap qua nhanh. binh tinh!' );
					else element.val(status);
				}
			});
		},
	"displayAllRoute" : function(m_arrayPoint){
		 v_map.directionsDisplay.setMap(null);
		 v_map.directionsDisplay.setMap(v_map.map);
		var waypts =[];
		if(m_arrayPoint.length>=2){
			
			for (index = 1; index < m_arrayPoint.length-1; ++index) {
				  waypts.push({
	        		location: m_arrayPoint[index].mark.getPosition(),
	        		stopover: true
	      			});
				}
			  v_map.directionsService.route({
			        origin: m_arrayPoint[0].mark.getPosition(),
			        destination: m_arrayPoint[m_arrayPoint.length-1].mark.getPosition(),
			        waypoints: waypts,
        			optimizeWaypoints: false,
			        travelMode: 'DRIVING'
			    }, function(response, status) {
			        if (status === 'OK') {
			            v_map.directionsDisplay.setDirections(response);
			        } else {
			        	if(status==OVER_QUERY_LIMIT)
            			window.alert('Ban nhap qua nhanh. binh tinh!' );
            			else window.alert('Directions request failed due to ' + status);
          			}
			    });
			}else{
				 v_map.directionsDisplay.setMap(null);
			}
		}
	};
