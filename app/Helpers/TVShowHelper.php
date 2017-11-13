<?php

namespace App\Helpers;

class TVShowHelper
{
    static function getAllShowsFromAPI()
    {
        /* 
         * Will probably use Guzzle here.
         * Function is will be obsolete soon since the whole process eats way too much memory and it's a one off thing anyway.
         * If we use this I'll probably add each show to the database in a better way.
         */

        $seriesBaseURL = 'http://api.tvmaze.com/shows?page=';
        $i = 130;
        $series = array();

        while(true)
        {
            $seriesURL = $seriesBaseURL . $i;
            echo 'Getting URL: ' . $seriesURL;
            TVShowHelper::checkResponse(json_decode(file_get_contents($seriesURL)));
            $series[] = json_decode(file_get_contents($seriesURL));
            
            $i++;
        }
        
        return $series;
    }

    static function checkResponse($result)
    {
        if(!$result) {
            return false;
        } else {
            return true;
        }
    }

}
