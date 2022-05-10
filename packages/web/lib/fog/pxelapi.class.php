<?php

/**
 * The core elements for calling PXEL Central API
 * @category PXELApi
 * @package  FOGProject
 * @author   CES Team 
 */
class PXELApi extends FOGBase
{
    public $pxelurl;
    public $pxeltoken;
    public $client;

    function __construct()
    {
        $this->pxelurl = self::getSetting("PXEL_API_URL");
        $this->pxeltoken = self::getSetting("PXEL_API_KEY");
    }

    /**
        * PXEL Transfer Image API
        * @param string $requestdata - SourceSiteName, DestinationSiteName, ImageName
        */
    public function transferImage($requestdata)
    {
        $this->SocketCallAPI("POST", "api/Image/Transfer", $this->pxeltoken, $requestdata);
    }

    /**
        * PXEL List All Sites API
        * @return string
        */
    public function listSites()
    {
        return $this->CurlCallAPI("GET","api/Site",false);
    }

    /**
        * PXEL List Images By Site API
        * @param string $siteCode - SiteName
        * @return string
        */
    public function listImagesBySite($siteCode)
    {
        return $this->CurlCallAPI("GET","api/Image",$siteCode);
    }

    /**
        * Executing a cURL command (GET, POST) to RESTful API in main thread (For fast response API)    
        * @param string $method call to use
        * @param string $endpoint to request
        * @param array $data for cURL
        * @return string
        */
    private function CurlCallAPI($method, $endpoint, $data = false)
    {     
        // Initializes cURL class and URL to PXEL Central API
        $curl = curl_init();
        $url = $this->pxelurl.$endpoint;

        // Configures API token into header of request call
        $headers = array(
            "X-Api-Key: ".$this->pxeltoken,
            "Content-Type: application/json"
        );

        // Setting type of calls based on user input
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s/%s", $url, $data);
        }

        // Configures cURL call settings
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        
        // Execute cURL command call to PXEL Central API server
        $result = curl_exec($curl);

        
        // Error handling
        if(curl_errno($curl))
        {   
            throw new Exception(curl_error($curl) . ' (' .curl_errno($curl). ')');
        }
        else if(curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400)
        {
            $response = json_decode($result);
            throw new Exception($response->Message . ' (' .curl_getinfo($curl, CURLINFO_HTTP_CODE). ')');
        }
        
        
        // Close cURL session and frees all resources
        curl_close($curl);

        return $result;
    }

    /**
     * Send a HTTP request, but do not wait for the response (For long response API)     
     * @param string $method The HTTP method
     * @param string $endpoint The endpoint of the PXEL API
     * @param string $url The url 
     * @param string $data Added to the request body 
     */
    public function SocketCallAPI(string $method, string $endpoint, string $apitoken , string $data): void
    {
        $parts = parse_url($this->pxelurl.$endpoint);
        if ($parts === false)
            throw new Exception('Unable to parse URL');
        $host = $parts['host'] ?? null;
        $port = $parts['port'] ?? 80;
        $path = $parts['path'] ?? '/';
        $query = $parts['query'] ?? '';
        parse_str($query, $queryParts);

        // Check if Web App able to connect to PXEL Central API
        if ($host === null)
            throw new Exception('Unknown host');
        $connection = fsockopen($host, $port, $errno, $errstr, 30);
        if ($connection === false)
            throw new Exception('Unable to connect to ' . $host);
        $method = strtoupper($method);

        // Build request
        $request  = $method . ' ' . $path;
        if ($queryParts) {
            $request .= '?' . http_build_query($queryParts);
        }

        // Request Settings
        $request .= ' HTTP/1.1' . "\r\n";
        $request .= 'Host: ' . $host . "\r\n";
        $request .= 'Content-Type: application/json' . "\r\n";
        $request .= 'Content-Length: ' . strlen($data) . "\r\n";
        $request .= 'X-Api-Key: ' . $apitoken . "\r\n";
        $request .= 'Connection: Close' . "\r\n\r\n";
        $request .= $data;

        // Send request to server
        fwrite($connection, $request);
        fclose($connection);
    }
}