<!--
Cesar Neri
ceneri@ucsc.edu
October 30, 2016
prefix.php

Get a prefix and an array, and returns an array with element that do not contain the prefix
-->

<?php

        //Url to send the JSOn to
        $url = 'http://challenge.code2040.org/api/prefix';
        $url2 = 'http://challenge.code2040.org/api/prefix/validate';
        $array2;
                   
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
        
        //Get string to look for
        $prefix = $response->{'prefix'};
        //Array of strings
        $array = $response->{'array'};
        
        //Go trough the array and compare strings
        for ($i = 0, $count = 0; $i < count($array); $i++ ){
            //Get the first four characters of each the string element
            $string_start = substr($array[$i], 0, 4) ; 
            //compare the four characters with the prefix
            if ( strcmp($prefix, $string_start) != 0){
                //If they do not match store the string in the output array
                $array2[$count] = $array[$i];
                $count++;
            }
        }
        
        //---------This is not required, is only used for visual rpresentation
        
        //print String response
        echo ("<p>Prefix: ");
        echo $prefix . "</p>";
        
        //print array
        echo ("<p>Array: ");
        //print_r( , true) returns strin version of array)
        echo print_r($array, true) . "</p>";
        
        //print array
        echo ("<p>Array2: ");
        //print_r( , true) returns strin version of array)
        echo print_r($array2, true) . "</p>";

        
        //------------------------------------------------------------
        
        //Data to be contained inside the response JSON
        $data2 = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
            'array' => $array2,
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
        //Response is a String
        $result2 = file_get_contents( $url2, false, $context2 );

?>