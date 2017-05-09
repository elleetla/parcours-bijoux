(function($){

    $( "#menu-item-241" ).click(function() {
        $( "#nav-search" ).slideToggle( "slow", function() {
            // Animation complete.
        });
    })

    //* slider
    $(".owl-carousel").owlCarousel({
        items:1,
        loop:false,
        center:true,
        nav:true,
        navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        autoHeight:true
    });
    //* .slider

})(jQuery);

function initMap() {

    var mapParcoursBijoux = [
        {
            elementType: 'geometry',
            stylers: [{color: '#fff2e9'}]
        },
        {
            elementType: 'labels.icon',
            stylers: [{visibility: 'ffcead'}]
        },
        {
            elementType: 'labels.text.fill',
            stylers: [{color: '#ffb687'}]
        },
        {
            elementType: 'labels.text.stroke',
            stylers: [{color: '#f5f5f5'}]
        },
        {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#bdbdbd'}]
        },
        {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#f8e4d7'}]
        },
        {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
        },
        {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#f8e4d7'}]
        },
        {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ffb687'}]
        },
        {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#ffffff'}]
        },
        {
            featureType: 'road.arterial',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
        },
        {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#ffcead'}]
        },
        {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
        },
        {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
        },
        {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
        },
        {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#f8e4d7'}]
        },
        {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#fffaf6'}]
        },
        {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
        }
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 48.866667, lng: 2.333333 },
        scrollwheel: false,
        zoom: 11,
        disableDefaultUI: false,
        styles: mapParcoursBijoux
    });

    function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
            url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(22, 29),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 29)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {
            var beach = beaches[i];
            var marker = new google.maps.Marker({
                position: {lat: beach[1], lng: beach[2]},
                map: map,
                icon: image,
                shape: shape,
                title: beach[0],
                zIndex: beach[3]
            });
        }

        $.ajax({
            url: "http://localhost:8888/parcours-bijoux/markers.json",
            context: document.body
        }).done(function(data) {

            //$( this ).append(JSON.stringify(data));
            console.log(data);
            var marker = new google.maps.Marker({
                position: data,
                map: map,
                title: 'Hello World!'
            });

        });

    }

    document.getElementById("button-map").onclick = function() {
        getLocaltion();
    };

    function getLocaltion(){

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                map.setZoom(15);

                var infoWindow = new google.maps.InfoWindow({map: map});

                infoWindow.setPosition(pos);
                infoWindow.setContent('<p style="margin: 0; color: #e74c3c; font-weight: 300;">Vous êtes ici !</p>');
                map.setCenter(pos);
            },function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

    }

    setMarkers(map);
}
// end initMap

var beaches = [
    ['Bondi Beach', 48.866667, 2.333333],
    ['Froment', 48.8677952, 2.3279679],
    ['Iesa saint augustin', 48.8688285, 2.3376012],
    ['elle&la', 48.8936866, 2.3371175],
];

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}
// end handleLocationError