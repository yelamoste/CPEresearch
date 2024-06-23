<?php

function db_connect() {
        $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'id22098548_elibrary_db';
  
    // Create a new database connection
    $conn = new mysqli($host, $user, $password, $dbname);
   
    // Check for errors
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }else{
      // Return the database connection object
      return $conn;
    }
  }

function truncateString($string, $max_length) {
    if (strlen($string) > $max_length) {
        return substr($string, 0, $max_length) . "...";
    }
    return $string;
}
function keywordExplode($keyword){
  $key = explode("," , $keyword);
  $keywordLength = count($key);
  for($i = 0; $i < $keywordLength; $i++){
      echo $key[$i];
  }
}

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

    function getTimeDifference($commentTime) {
    // Get the current time as a DateTime object
    $currentTime = new DateTime();
  
    // Convert the comment time string to a DateTime object
    // Assuming $commentTime is stored in a format like "YYYY-MM-DD HH:II:SS"
    $commentTimeObject = new DateTime($commentTime);
  
    // Calculate the time difference between comment time and current time
    $interval = $currentTime->diff($commentTimeObject);
  
    // Define an array to hold time units (years, months, days, hours, minutes, seconds)
    $timeUnits = array(
      'y' => 'year',
      'm' => 'month',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
    );
  
    // Loop through time units
    foreach ($timeUnits as $unit => $label) {
      // Get the difference in that unit (e.g., number of days)
      $value = $interval->$unit;
  
      // Check if the difference is greater than zero
      if ($value > 0) {
        // If yes, return a formatted string (e.g., "2 days ago")
        $timeString = $value . " " . $label . ($value > 1 ? 's' : '');
        return $timeString . " ago";
      }
    }
  
    // If no difference found in any unit, return "Just now"
    return "Just now";
  }


?>