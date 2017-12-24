<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Canada Drinking</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')  }}">
</head>
<body>
<div class="container-fluid full">
    <div id="map" style="width: 100vw; height: 100vh;"></div>
    <img id="progress" src="{{ asset('images/progress.gif') }}"/>
</div>
<script>
    function initMap() {
        var infoWindows = [];
        var uluru = {lat: {{$stores[0]->getLatitude()}}, lng: {{$stores[0]->getLongitude()}}};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });

        @foreach($stores as $store)
        // Markers creation
        var {{ 'marker' . $store->getId()  }} =
        new google.maps.Marker({
            position: {lat: {{$store->getLatitude()}}, lng: {{$store->getLongitude()}} },
            animation: google.maps.Animation.DROP,
            map: map
        });


        // Infowindows creation
        var {{ 'infowindow' . $store->getId()  }} =
        new google.maps.InfoWindow({
            content: '<b>' + '{{ $store->getName()  }}' + '</b><br>' + '{{ $store->getAddressLine1() }}' +
            '<br>' + '{{ $store->getCity()  }}' + '<br>' + '{{ $store->getTelephone()  }}' +
            '<hr>Total volume: <em>' + '{{ $store->getInventoryVolumeInMilliliters()/ 100 }}' + ' litres</em>' +
            '<br>Total items: <em>' + '{{ $store->getInventoryCount()  }}' + ' pcs.</em>' +
            '<br>Total price: <em>$' + '{{ $store->getInventoryPriceInCents() / 100 }}' + '</em>' +
            '<hr>' +
            '<img src="{{ $store->getHasWheelchairAccessability() ? asset('images/wheelchair.png') : asset('images/unavailable.png')  }}" alt="Wheelchair access available" title="Wheelchair access available"/>' +
            '<img src="{{ $store->getHasBeerColdRoom() ? asset('images/room.png') : asset('images/unavailable.png')  }}" alt="Beer cold room" title="Beer cold room"/>' +
            '<img src="{{ $store->getHasVintagesCorner() ? asset('images/vintage.png') : asset('images/unavailable.png')  }}" alt="Vintage corner" title="Vintage corner"/>' +
            '<img src="{{ $store->getHasParking() ? asset('images/parking.png') : asset('images/unavailable.png')  }}" alt="Parking" title="Parking"/>' +
            '<img src="{{ $store->getHasProductConsultant() ? asset('images/consultant.png') : asset('images/unavailable.png')  }}" alt="Consultant" title="Consultant"/>' +
            '<img src="{{ $store->getHasSpecialOccasionPermits() ? asset('images/permit.png') : asset('images/unavailable.png')  }}" alt="Special occasion permits" title="Special occasion permits"/>' +
            '<img src="{{ $store->getHasTastingBar() ? asset('images/tasting.png') : asset('images/unavailable.png')  }}" alt="Tasting bar" title="Tasting bar"/>' +
            '<img src="{{ $store->getHasTransitAccess() ? asset('images/transit.png') : asset('images/unavailable.png')  }}" alt="Transit access" title="Transit access"/>' +
            '<img src="{{ $store->getHasBilingualServices() ? asset('images/language.png') : asset('images/unavailable.png')  }}" alt="Bilingual services" title="Bilingual services"/>'

        });


        infoWindows.push({{ 'infowindow' . $store->getId()  }});

        // On marker click listener
        ({{ 'marker' . $store->getId()  }}).addListener('click', function () {

            // Close all open windows
            infoWindows.forEach(function (infoWindow) {
                infoWindow.close();
            });

            // Open the window user clicked on
            ({{ 'infowindow' . $store->getId()  }}).open(map, {{ 'marker' . $store->getId()  }});

            // Set map center by marker position
            map.setCenter({lat: {{$store->getLatitude()}}, lng: {{$store->getLongitude()}}});
        });

        @endforeach
        document.getElementById('progress').setAttribute('style', 'display:none;');
    }
</script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXQJffdjom8E0R02jGSSfPoJPYFswsyRk&callback=initMap">
</script>
</body>
</html>
