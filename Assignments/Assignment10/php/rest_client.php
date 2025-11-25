<?php
function getWeather() {
    $ack = "";
    $out = "";
    
    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code={$_POST['zip_code']}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if ($response === false) {
         echo 'Error: ' . curl_error($ch);
         return [$ack, $out];
    } else {
        if (empty($_POST['zip_code'])) {
            $ack = json_decode($response, true);
            $ack = $ack["error"];
            return [$ack, $out];
        } else {
            $data = json_decode($response, true);
            if (isset($data['error'])) {
                $ack = $data['error'];
                return [$ack, $out];
            } else {
                $city = $data['searched_city']['name'];
                $temp = $data['searched_city']['temperature'];
                $humidity = $data['searched_city']['humidity'];
                $forecast = $data['searched_city']['forecast'];

                $out .= "<h2>{$city}</h2>";
                $out .= "<p><strong>Temperature:</strong> {$temp}</p>";
                $out .= "<p><strong>Humidity:</strong> {$humidity}</p>";
                $out .= "<p><strong>3-Day forecast</strong></p><ul>";
                foreach ($forecast as $day) {
                    $out .= "<li>{$day['day']}: {$day['condition']}</li>";
                }
                $out .= "</ul>";
                $warmer = $data['higher_temperatures'];
                if (count($warmer) === 0) {
                    $out .= "<p><strong>There are no cities with temperatures higher than {$city}.</strong></p>";
                } else {
                    $out .= "<p><strong>Up to three cities where temperatures are higher than {$city}</strong></p>";
                    $out .= "<table class='table table-striped'><tr><th>City Name</th><th>Temperature</th></tr>";

                    foreach ($warmer as $c) {
                        $out .= "<tr><td>{$c['name']}</td><td>{$c['temperature']}</td></tr>";
                    }
                    $out .= "</table>";
                }
                $colder = $data['lower_temperatures'];
                if (count($colder) === 0) {
                    $out .= "<p><strong>There are no cities with temperatures lower than {$city}.</strong></p>";
                } else {
                    $out .= "<p><strong>Up to three cities where temperatures are lower than {$city}</strong></p>";
                    $out .= "<table class='table table-striped'><tr><th>City Name</th><th>Temperature</th></tr>";

                    foreach ($colder as $c) {
                        $out .= "<tr><td>{$c['name']}</td><td>{$c['temperature']}</td></tr>";
                    }

                    $out .= "</table>";
                }

                return [$ack, $out];
            }
        }
    }
}
//Explain the difference between a REST API client and a REST API server. What role does this code play in that relationship?
//Why is JSON commonly used for API responses? What are the benefits of using JSON over other data formats like XML?
//Explain the difference between a REST API client and a REST API server. What role does this code play in that relationship?
//How should an application handle different types of API responses (success, error, empty data)? What considerations are important for each scenario?
//What is cURL used for in web development?
?>