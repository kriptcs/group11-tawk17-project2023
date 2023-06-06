<?php
class MemeFetcher
{ 
public $theCode;
    public function getMeme($text0,$text1)
    {
        //PHP5, Curless method to send a POST Request

        //URL to send the POST Request to
        $url = 'https://api.imgflip.com/caption_image';
        
        //Information array for the POST Request
        $data = array('template_id' => '181913649', 'username' => 'kript', 'password' => 'AltaLimba', 'text0' => $text0, 'text1' => $text1);

        //The POST Request
        $options = array(
                        'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data)
                        )
                    );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
            //ERROR HANDLING
            if ($result === FALSE) { debug_to_console("there was an error"); }
            
            //Fetch the URL end from the result
            $theCode=substr($result,56,10);
                       
?>
<!-- <img src="https://i.imgflip.com/<?php echo $theCode ?>">     -->  

<?php
return $theCode;
}
}


