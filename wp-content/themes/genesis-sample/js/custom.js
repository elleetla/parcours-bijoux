(function($){

    // Animation menu search site
    $( "#menu-item-241" ).click(function() {
        $( "#nav-search" ).slideToggle( "slow", function() {
        });
    });

    //* slider page categorie lieux
    $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        center:true,
        nav:true,
        navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        autoHeight:true
    });

    // Map

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

    function render_map( $el ) {

        // var
        var $markers = $(document).find('.marker');

        // vars
        var args = {
            zoom        : 11,
            center      : new google.maps.LatLng(48.866667, 2.333333),
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP]
            },
            styles: mapParcoursBijoux
        };

        // create map
        var map = new google.maps.Map( $el[0], args);

        // add a markers reference
        map.markers = [];
        // add markers
        index=0;
        $markers.each(function(){
            add_marker( $(this), map, index);
            index++;
        });

        // center map
        center_map( map );

    }

    function add_marker( $marker, map, index ) {

        // var
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        var image = new google.maps.MarkerImage("https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png", null, null, null, new google.maps.Size(25,30));

        // create marker
        var marker = new google.maps.Marker({
            position    : latlng,
            map         : map,
            icon        : image
        });

        // add to array
        map.markers.push( marker );


        // if marker contains HTML, add it to an infoWindow
        if( $marker.html() )
        {
            $('.structure-places').append('<div class= "linkage" id="p'+index+'">'+$marker.html()+'</div>'); // change html here if you want but eave id intact!!

            $(document).on('click', '#p'+index, function(){
                infowindow.open(map, marker);
                setTimeout(function () { infowindow.close(); }, 5000);
            });

            // create info window
            var infowindow = new google.maps.InfoWindow({
                content     : $marker.html(),
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function() {

                infowindow.open( map, marker );

            });

        }

    }

    function center_map( map ) {

        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each( map.markers, function( i, marker ){

            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

            bounds.extend( latlng );

        });

        // only 1 marker?
        if( map.markers.length == 1 )
        {
            // set center of map
            map.setCenter( bounds.getCenter() );
            map.setZoom( 11 );
        }
        else
        {
            // fit to bounds
            map.fitBounds( bounds );
        }

    }

// Call it

    $('.acf-map').each(function(){

        render_map( $(this) );

    });

})(jQuery);