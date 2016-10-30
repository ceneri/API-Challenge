
<!--
Cesar Neri
ceneri@ucsc.edu
October 30, 2016
reverse.php

Outputs the reverse of the specified string
-->

<?php

        //Url to send the JSOn to
        $url = 'http://challenge.code2040.org/api/reverse';
        $url2 = 'http://challenge.code2040.org/api/reverse/validate';
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
        //Response is a String
        $result = file_get_contents( $url, false, $context );
         
        //print String response
        echo ("<p>String response: ");
        echo $result . "</p>";
         
        //Transfrom String to array
        $string_array = str_split($result);
         
        //add all characters from response to string in reverse order
        for ($i = count($string_array) - 1; $i >= 0; $i--){
            $reverse .= $string_array[$i];
            //$reverse = $string_array[$i];
        }
         
        //print String response
        echo ("<p>String reversed: ");
        echo $reverse . "</p>";
        
        //Data to be contained inside the response JSON
        $data2 = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
            'string' => $reverse,
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
         
        //Response in JSOn
        //$response = json_decode( $result );

?>
