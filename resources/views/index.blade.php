<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
            #map {
                height: 100%;
            }

            /* Optional: Makes the sample page fill the window. */
            html,
            body {
                height: 100%;
                margin: 0 0 0 5%;
                padding: 0;
            }
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1>Demo</h1>
            <div class="map" id="app">
                <form action="{{route('getMarkers')}}" method="post">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date">
                    </div> -->
                    <div class="form-group">
                        <label for="address">Street</label>
                        <input type="text" id="address" name="address">
                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit" >

                </form>
                <gmap-map
                    :center={{$center}}
                    :zoom="10"
                    style="width:60%; height: 400px;"
                >
                    <gmap-marker
                        v-for="(location, index) in {{$locations}}"
                        :key="index"
                        :label="location.title"
                        :title="location.title"
                        :position="{lat:location.lat, lng:location.lng}"
                        :clickable="true"
                        :draggable="false"
                    ></gmap-marker>

                </gmap-map>

            </div>
        </div>

    </div>
    <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
