<?php

require __DIR__ . "/../meme-data-access/MemeFetcher.php";

class MemeService {
    public static function getMeme($text0, $text1){
        $meme_fetcher = new MemeFetcher();

        $meme_text_data = $meme_fetcher->getMeme($text0, $text1);
                debug_to_console($meme_text_data);


        $text = isset($meme_text_data["result"]) ? $meme_text_data["result"] : "ERROR IN SERVICE";



        return $meme_text_data;
    }

}