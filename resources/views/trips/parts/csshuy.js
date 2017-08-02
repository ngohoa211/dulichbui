var map;
var geocoder;
var index = 0;
var plans = [];
var marker_start;
var marker_end;

function initMap() {
    // create map
    map = new google.maps.Map(document.getElementById('map_canvas'), {
        center: {lat: 21.0245, lng: 105.84117},
        zoom: 8
    });
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    //marker
    geocoder = new google.maps.Geocoder();
    google.maps.event.addListener(map, 'click', function(event) {
        var input = $("input:checked").val();
        placeMarker(event.latLng, input);
    }); 

    function placeMarker(location, input) {
        if (input == "start") {
            if (marker_start) {
                marker_start.setPosition(location);
            } else {
                marker_start = new google.maps.Marker({ 
                    position: location, 
                    map: map,
                });
            }
            getAddress(location, input);
        } else {
            if (marker_end) {
                marker_end.setPosition(location); 
            } else {
                marker_end = new google.maps.Marker({ 
                    position: location, 
                    map: map,
                });
            }
            getAddress(location, input);
        }

        if (marker_start && marker_end) {
            calculateAndDisplayRoute(directionsService, directionsDisplay, marker_start, marker_end);
        }
    }
    
    
    //search box
    var input = document.getElementById('search-box');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
    //end search box 
}

function getAddress(latLng, input) {
    geocoder.geocode( {'latLng': latLng},
    function (results, status) {
        console.log(status);
        var box = $('#' + input);
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                box.val(results[0].formatted_address);
            } else {
                box.val("No results");
            }
        } else {
            box.val(status);
        }
    });
}

function calculateAndDisplayRoute(directionsService, directionsDisplay,marker_start, marker_end) {
    var waypts = [];
    /*if (index == 1) {*/
    plans[index] = {
        start_lat : marker_start.getPosition().lat(),
        start_lng : marker_start.getPosition().lng(),
        end_lat : marker_end.getPosition().lat(),
        end_lng : marker_end.getPosition().lng()
    };
    var stay = $("#stay").val();
    if (stay == 1) {
        plans[index].stay = 1;
    } else {
        plans[index].stay = 0;
    }
        /*markerArray[1] = {
            location: marker_end.getPosition(),
            stopover: true
        };
    } else {
        markerArray[index] = {
            location: marker_end.getPosition(),
            stopover: true
        };
        var waypts = markerArray.slice(1, markerArray.length);
    }*/
    var index_waypts = 0;
    if(index > 0){
        for (i = 0; i < plans.length - 1; i++) {
            if (plans.stay) {
                continue;
            }
            waypts[index_waypts] = {
                location : new google.maps.LatLng(plans[i].end_lat, plans[i].end_lng),
                stopover : true
            }
            index_waypts++;
        }
    }
    console.log(waypts);

    directionsService.route({
        origin: new google.maps.LatLng(plans[0].start_lat, plans[0].start_lng),
        destination: new google.maps.LatLng(plans[plans.length -1].end_lat, plans[plans.length - 1].end_lng),
        waypoints: waypts,
        optimizeWaypoints: false,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } 
    });
}

function addPlan() {
    if (!marker_start || !marker_end) {
        alert("Please select location");
        return false;
    }
    index++;
    $("#start-radio").prop('disabled', true);
    $("#start").val($('#end').val());
    $("#end").val("");
    $("#stay").val(0);
    $("#combo-box").css("display", "block");
    marker_start.setPosition(marker_end.getPosition());
}

$("#add-button").on('click',addPlan);

//stay here
$("#stay").change(function() {
    var stay = $("#stay").val();
    if (stay == 1) {
        $("#end-radio").prop('disabled', true);
        marker_end.setPosition(marker_start.getPosition());
        $("#end").val($("#start").val());
    }
});

$('#create-navbar').addClass('active');