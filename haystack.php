<!--
Cesar Neri
ceneri@ucsc.edu
October 30, 2016
haystack.php

Looks for the index of a specified string inside a provided String array
-->

<?php

        //Url to send the JSOn to
        $url = 'http://challenge.code2040.org/api/haystack';
        $url2 = 'http://challenge.code2040.org/api/haystack/validate';
        $reverse = "";
                   
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
        $needle = $response->{'needle'};
        //Array of strings
        $haystack = $response->{'haystack'};
        
        //Go trough the array and compare strings
        for ($i = 0; $i < count($haystack); $i++ ){
            if ( strcmp($needle, $haystack[$i]) == 0){
                //If a match is found store the  index
                $index = $i;
                break;
            }
        }
        
        //---------This is not required, is only used for visual rpresentation
        
        //print String response
        echo ("<p>Needle: ");
        echo $needle . "</p>";
        
        //print array
        echo ("<p>Haystack: ");
        //print_r( , true) returns strin version of array)
        echo print_r($haystack, true) . "</p>";
        
        //print index
        echo ("<p>Index: ");
        echo $index . "</p>";
        
        //------------------------------------------------------------
        
        //Data to be contained inside the response JSON
        $data2 = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
            'needle' => $index,
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
