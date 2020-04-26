<?php

namespace COVIDPress\DataSources;

require_once(__DIR__.'/DataSource.php');
use COVIDPress\DataSources\DataSource;

class EMMNewsBrief extends DataSource {

    public function __construct(String $lang = 'en')
    {
        $this->setEndPoint('https://emm.newsbrief.eu/rss/rss?type=rtn&language='.$lang);
    }

    public function getDecodedResponse()
    {
        $raw = $this->getResponseBody();
        try {
            $decodedResponse = simplexml_load_string($raw);
            return  json_decode(json_encode($decodedResponse), false);
        } catch (\Throwable $th) {
            throw new \Exception(_('Error decoding the EMMNewsBrief DataSource'), 0, $th);
        }
    }

    public function getNews(int $limit = 0, Array $categories = ['CoronavirusInfection']) : Array
    {
        $newsItems = $this->getDecodedResponse()->channel->item;
        $filteredNews = array_filter($newsItems, function ($item) use ($categories) {
            $itemAsArray = (array)$item;
            if (key_exists('category', $itemAsArray)) {
                $itemsCategories = (array)$itemAsArray['category'];
                return boolval(array_intersect($itemsCategories, $categories));
            }
            return false;
        });
        if ($limit > 0 && sizeof($filteredNews) > $limit) {
            return array_slice($filteredNews, 0, $limit);

        }
        return $filteredNews;

    }

}