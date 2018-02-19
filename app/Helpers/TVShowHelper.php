<?php

namespace App\Helpers;

use App\Series;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;

class TVShowHelper
{
    public function getShow($show_id)
    {
        $url = Series::find($show_id)->location_url;

        $client = new Client();
        $data = $client->request('GET', $url);
        $show = $data->getBody();

        return $show;
    }

    public function getEpisodesForShow($show)
    {
        $url = $show->url_location . '/episodes';

        $episodes = $this->getDataFromPage($url);

        return $episodes;
    }

    public function createSeries($url)
    {
        $client = new Client();
        $data = $client->request('GET', $url);
        $show = json_decode($data->getBody());

        $series = Series::create([
            'title' => $show->name,
            'slug' => str_slug($show->name),
            'synopsis' => $show->summary,
            'url_location' => $show->_links->self->href,
            'cover_img_location' => $show->image->original,
        ]);

        return $series;
    }


    function checkForDuplicates($show)
    {
        $series = Series::where('slug', str_slug($show->name))->first();

        if($series)
        {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Very temp function to mass add shows ONCE. 
     * Or maybe multiple times if necessary.
     * Will revamp if I need to reuse this
     */

    /*function checkValidity($data)
    {
        $checkFor = [
            'summary' => 'Summary is not available right now.', 
            'image->original' => 'cover_img is not available right now.',
        ];

        foreach($checkFor as $item) {
            if(isset($data->item) == false)
            {
                $data = $data;
            }
        }

    }*/

    function massCreateSeriesFromAPI()
    {
        $lastPage = 133;
        $baseURL = 'http://api.tvmaze.com/shows?page=';        
        
        for($currentPage = 0; $currentPage <= $lastPage; $currentPage++)
        {
            $url = $baseURL . $currentPage;

            $client = new Client();
            $data = $client->request('GET', $url);
            $shows = json_decode($data->getBody());

            foreach($shows as $show)
            {
                
                if($this->checkForDuplicates($show) == false)
                {
                    $series = Series::create([
                        'title' => $show->name,
                        'slug' => str_slug($show->name),
                        'synopsis' => isset($show->summary), // Okay use normal laravel validation instead of isset which just checks whether the value exists:)
                        'url_location' => $show->_links->self->href,
                        'cover_img_location' => isset($show->image->original),
                    ]);
                    
                    print "Created " . $show->name . PHP_EOL;
                } else {
                    print "Duplicate found. Skipping..." . PHP_EOL;
                }

            }
            print '*** Current on page '. $currentPage . PHP_EOL;
        }
    }        

    function checkPages()
    {
        $baseURL = 'http://api.tvmaze.com/shows?page=';
        $i = 0;
        $allURLS = array();
        
        while(true) {
            $url = $baseURL . $i;

            if($this->performRequest('GET', $url) ==! false)
            {
                $allURLS[] = $url;
                
            }
            else {
                break;                
            }

            $i++;
        }

        return $allURLS;
    }

    function getDataFromPage($url)
    {
        $client = new Client();
        $data = $client->request('GET', $url);

        return $data->getBody();
    }

    function checkValidity($show)
    {
        foreach($show as $key => $value)
        {
            
        }
    }

    function getNewShows()
    {
        $pages = $this->checkPages();

        foreach($pages as $page)
        {
            $shows = $this->getShowsFromPage($page);

            foreach($shows as $show)
            {
                $show = $this->checkValidity($show);
            }
        }
    }

    function performRequest($type, $url)
    {
        $client = new Client();
        
        try {
            $client->request($type, $url);
            return $client->request($type, $url);
            
        } catch (ClientException $e) {
            //echo Psr7\str($e->getRequest());
            //echo Psr7\str($e->getResponse());

            return false;
        }

    }



}


