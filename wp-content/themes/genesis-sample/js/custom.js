(function($){

    $( "#menu-item-241" ).click(function() {
        $( "#nav-search" ).slideToggle( "slow", function() {
            // Animation complete.
        });

    //slider
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
})

})(jQuery);

function initMap() {

    var styleParcoursBijoux = [
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

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 48.8589506,
            lng: 2.3407315,
        },
        zoom: 13,
        styles: styleParcoursBijoux,
        disableDefaultUI: false,
        mapTypeControl: false,
        scrollwheel: false,
    });


    document.getElementById("button-geolocation").onclick = function() {getLocation()};

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                map.setZoom(15);

                var infoWindow = new google.maps.InfoWindow({map: map});

                infoWindow.setPosition(pos);
                infoWindow.setContent('<h5 style="margin: 0; color: #e74c3c;">Votre position</h5>');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        // End try HTML5 geolocation
    }

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}