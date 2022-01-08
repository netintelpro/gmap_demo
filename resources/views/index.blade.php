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
            <div>
                <form>
                    <label for="start">Start date:</label>

                    <input type="date" id="start" name="start">

                    <label for="end">End date:</label>

                    <input type="date" id="end" name="end">

                    <label for="address">Address</label>
                    <input type="address">
                </form>

            </div>
            <div class="map" id="app">
                <gmap-map
                    :center=@json(config('google.maps.austin'),JSON_NUMERIC_CHECK)
                    :zoom="7"
                    style="width:50%; height: 320px;"
                ></gmap-map>
            </div>
        </div>

    </div>
    <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
