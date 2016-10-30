
<!--
Cesar Neri
ceneri@ucsc.edu
October 30, 2016
index.php

Sends a JSOn to the specified location containing personal token and 
github address

-->


<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <title>2040 Challenge</title>
    </head>
    
    <header>
        <h1>2040 Challenge: First Part</h1>
    </header>
    
    <body>
 
        <?php

        //Url to send the JSOn to
        $url = 'http://challenge.code2040.org/api/register';
                   
        //Data to be contained inside the JSON
        $data = array(
            'token'  => 'f5b79e8901de60674023933c1a5ad4fd',
            'github' => 'https://github.com/ceneri/API-Challenge.git',
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
         $result = file_get_contents( $url, false, $context );
         $response = json_decode( $result );
         
        ?> 
        
        <p></p>
        
    </body>
    
    <footer>
        &COPY Cesar Neri 2016; 
    </footer>
    
</html>