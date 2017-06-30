$(function() {

    //* filter label for English homepage
    var html = document.getElementsByTagName("html")[0].getAttribute("lang");
    if(html == "en-GB"){
        $( ".sf-field-taxonomy-categorie option.sf-item-0" ).html( "events" );
        $( ".sf-field-taxonomy-arrondissement option.sf-item-0" ).html( "places" );
        $( ".sf-field-taxonomy-artiste option.sf-item-0" ).html( "artists" );
        $( ".search-filter-reset" ).val( "reset" );

        /* CAUTION
        to set the link for resetting the English filter,
        http://demo.elle-et-la.com/parcours-bijoux/wp-content/plugins/search-filter-pro/public/assets/js/search-filter-build.js?ver=1.4.3
        at line 1525 was modified
        original code line became custom code line to deal with multi language website (Polylang plugin)*/
        $(".search-filter-reset").on("click",function(){
            // window.location.href='http://localhost:8888/parcours-bijoux/en/'; //link for localhost
            window.location.href='http://demo.elle-et-la.com/parcours-bijoux/en/'; //link for online website
        });
    }

/*
    //!* load more button
    $(".content-6 article:gt(5)").hide(); //hide posts greater than 5 == display the first 6 post

    $("#load-more-top, #load-more-bottom").on('click', function () {
        jQuery.post(
            ajaxurl,
            {
                'action': 'mon_action'
            },
            function (response) {
                $('.content-6').html(response);
            }
        );
        // ('.search-filter-form-646').show();
    });
*/

    function loadmore() {
        jQuery.post(
            ajaxurl,
            {
                'action': 'mon_action'
            },
            function (response) {
                $('.home-description .content').html(response);
            }
        );
        return false;
    }

    var one_time =true;
    $(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){
            if(one_time){
                loadmore();
               one_time = false;
            }


        }
    });


    //* animation/display menu search
     $( "#menu-item-241" ).click(function() {
         $( "#nav-search" ).slideToggle( "slow", function() {});
     });

    $( "#close-search" ).click(function() {
        $( "#nav-search" ).slideUp( "slow", function() {});
    });

    //* animation/display div contact
    $( "#button-contact" ).click(function() {
        $( "#contacts" ).slideToggle( "slow", function() {});
        return false;
    });


    //* slider page categorie lieux
    $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        center:true,
        nav:true,
        navText: ["<img src='/parcours-bijoux/wp-content/themes/genesis-sample/images/chevron_slider_gauche.svg'>","<img src='/parcours-bijoux/wp-content/themes/genesis-sample/images/chevron_slider_droit.svg'>"],
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
        $markers.each(function(){
            add_marker( $(this), map);
        });

        // center map
        center_map( map );

    }

    function add_marker( $marker, map ) {

        // var
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

        var image = new google.maps.MarkerImage("http://demo.elle-et-la.com/parcours-bijoux/wp-content/themes/genesis-sample/images/picto-test.png", null, null, null, new google.maps.Size(25,30));

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
            // $('.structure-places').append('<div class= "linkage" id="p'+index+'">'+$marker.html()+'</div>'); // change html here if you want but leave id intact!!

            $(document).on('click', '#'+$marker.attr('id'), function(){
                if (typeof( window.infoopened ) != 'undefined') infoopened.close();
                infowindow.open(map,marker);
                infoopened = infowindow;
            });

            // create info window
            var infowindow = new google.maps.InfoWindow({
                content     : $marker.html(),
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function() {
                if (typeof( window.infoopened ) != 'undefined') infoopened.close();
                infowindow.open(map,marker);
                infoopened = infowindow;
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

});