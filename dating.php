<!--
Cesar Neri
ceneri@ucsc.edu
October 30, 2016
dating.php

Get a date and interval of seconds and return a date string with the interval added to it
-->

<?php

        //Url to send the JSOn to
        $url = 'http://challenge.code2040.org/api/dating';
        $url2 = 'http://challenge.code2040.org/api/dating/validate';
        $datestamp;
                   
        //Data to be contained inside the JSON
        $data = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
        );

        //Create JSOn and specify type and method
        $options = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
            )
        );  
        
        //connection
        $context  = stream_context_create( $options );
        //Response is a JSON
        $result = file_get_contents( $url, false, $context );

        //JSON to object
        $response = json_decode( $result );
        
        //Get original datestamp
        $datestamp1 = $response->{'datestamp'};
        //Get seconds interval
        $interval = $response->{'interval'};
        
        //Create DateTime obj
        $datestamp_obj = new DateTime($datestamp1);
        
        //Create DateInterval obj
        $interval_obj = new DateInterval('PT' . $interval . 'S');
        
        //Add seconds to date 
        $datestamp_obj->add($interval_obj);
        
        //get datesamp string in ISO8601
        $datestamp =  $datestamp_obj->format("Y-m-d");
        $datestamp .=  "T";
        $datestamp .=  $datestamp_obj->format("H:i:s");
        $datestamp .=  "Z";
        
        //Not required just for visual display-------------------------------
        
        //print String response
        echo ("<p>Date: ");
        echo $datestamp1 . "</p>";
        
        //print array
        echo ("<p>Interval: ");
        //print_r( , true) returns strin version of array)
        echo $interval . "</p>";
        
        //print array
        echo ("<p>New Date: ");
        //print_r( , true) returns strin version of array)
        echo $datestamp . "</p>";

        
        //------------------------------------------------------------
        
        //Data to be contained inside the response JSON
        $data2 = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
            'datestamp' => $datestamp,
        );
        
        //Create response JSOn and specify type and method
        $options2 = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data2 ),
            'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
            )
        );
        
        //connection
        $context2  = stream_context_create( $options2 );
        //Response is a String date
        $result2 = file_get_contents( $url2, false, $context2 );

?>