<?php

namespace COVIDPress\DataSources;

abstract class DataSource {

    protected $endpoint = '';
    
    protected $headers = [];

    protected $response = null;

    private function fetch() 
    {
        if (!$this->response) {
            try {
                $this->response = wp_remote_get( $this->endpoint,  $this->headers);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return $this->response;
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
        if (!$this->response) {
            $this->fetch();
        }
        return $this->response;
    }

    protected function getResponseBody()
    {
        if (!$this->response) {
            $this->fetch();
        }
        return wp_remote_retrieve_body($this->response);
    }

    protected function getResponseCode()
    {
        if (!$this->response) {
            $this->fetch();
        }
        return wp_remote_retrieve_response_code($this->response);
    }

    abstract function getDecodedResponse();
}