<?php

namespace COVIDPress\DataSources;

require_once(__DIR__.'/DataSource.php');
use COVIDPress\DataSources\DataSource;

class euodpCOVID19 extends DataSource {
    
    public function __construct()
    {
        $this->setEndPoint('https://opendata.ecdc.europa.eu/covid19/casedistribution/json');
    }

    public function getDecodedResponse() : Array
    {
        $raw = $this->getResponseBody();
        try {
            $decodedResponse = json_decode($raw);
            return $decodedResponse->records;
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function getGlobalData()
    {
        $array = $this->getDecodedResponse();
        return $this->summarizeData($array);
    }

    public function getDataByCountry(String $geoId)
    {
        $array = $this->getDecodedResponse();
        $records = array_filter($array, function($obj) use ($geoId) {
            if (strtoupper($obj->geoId) === strtoupper($geoId)) {
                return true;
            }
            return false;
        });
        if (sizeof($records)) {
            $country = $records[array_key_last($records)]->countriesAndTerritories;
        }
        return $this->summarizeData($records, $country ?? $geoId);
    }

    public function getDataByContinent(String $continent)
    {
        $validContinents = ['Europe', 'Asia', 'America', 'Africa', 'Oceania'];
        if (!in_array($continent, $validContinents)) {
            return $this->getGlobalData();
        }
        $array = $this->getDecodedResponse();
        $records = array_filter($array, function($obj) use ($continent) {
            if (strtoupper($obj->continentExp) === strtoupper($continent)) {
                return true;
            }
            return false;
        });
        return $this->summarizeData($records, $continent);
    }

    private function summarizeData(Array $records, String $region = 'Global') : Array
    {
        $results = [
            "region" => $region,
            "deaths" => 0,
            "cases" => 0
        ];
        foreach ($records as $record) {
            $results["deaths"] += $record->deaths;
            $results["cases"] += $record->cases;
        }

        return $results;
    }

}