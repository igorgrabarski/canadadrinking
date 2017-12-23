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
    </head>
    <body>
        <div class="container-fluid">
            <div id="map" style="width: 100vw; height: 100vh;"></div>

        </div>
        <script>
            function initMap() {
                var uluru = {lat: {{$stores[0]->getLatitude()}}, lng: {{$stores[0]->getLongitude()}}};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: uluru
                });


                @foreach($stores as $store)
                var {{ 'marker' . $store->getId()  }} = new google.maps.Marker({
                        position: {lat: {{$store->getLatitude()}}, lng: {{$store->getLongitude()}} },
                        map: map
                    });
                @endforeach

            }
        </script>
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXQJffdjom8E0R02jGSSfPoJPYFswsyRk&callback=initMap">
        </script>
    </body>
</html>
