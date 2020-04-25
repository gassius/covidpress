<?php

namespace COVIDPress\DataSources;

abstract class DataSource {

    protected $endpoint = '';
    
    protected $headers = [];

    static $response = null;

    private function fetch() 
    {
        if (!self::$response) {
            try {
                self::$response = wp_remote_get( $this->endpoint,  $this->headers);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return self::$response;
    }

    protected function setEndPoint($endpoint) : String
    {
        return $this->endpoint = $endpoint;
    }

    protected function setHeaders(Array $headers) : Array
    {
        return $this->headers = $headers;
    }

    protected function getResponse()
    {
        if (!self::$response) {
            $this->fetch();
        }
        return $this->response;
    }

    protected function getResponseBody()
    {
        if (!self::$response) {
            $this->fetch();
        }
        return wp_remote_retrieve_body(self::$response);
    }

    protected function getResponseCode()
    {
        if (!self::$response) {
            $this->fetch();
        }
        return wp_remote_retrieve_response_code(self::$response);
    }

    abstract function getDecodedResponse();
}