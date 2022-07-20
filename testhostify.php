<?php
define('API_KEY', '');
define('API_URL', 'https://pmsapi.hostify.com/');

   $current_date = date('Y-m-d'); 
   $ch = curl_init();
   for ($i = 1; $i <= 1; $i++) {
   $ch = curl_init('https://pmsapi.hostify.com//reservations?page='. $i .'');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        'x-api-key: ' . API_KEY,
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);

    $server_output = json_decode($server_output, true);

    //var_dump($server_output);

    $reservation = $server_output['reservation'];
    $checkOut = strtotime($reservation['checkOut']);

    foreach($server_output['reservations'] as $key=>$item) {
    	if($item['status'] == 'accepted' && $item['checkOut'] > $current_date){
    		echo '<br>'. $item['confirmation_code'] . ' - ' . $item['checkIn'];
    	}
    }
    sleep(0); // Wait 1 second before retrying
 	}
   curl_close($ch);



?>
