<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 3:24 PM
 */

namespace App\Libs;


use App\Exceptions\WebsiteNotFoundException;

/**
 * Class CurlRequest
 * @package App\Libs
 */
abstract class CurlRequest
{
    /**
     * @param string $url
     * @param $method
     * @return String
     * @throws WebsiteNotFoundException
     */
    public static function curlGetRequest(string $url, $method): String
    {
        $contentType = "text/html";
        $curl = curl_init();
        curl_setopt_array($curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "charset=UTF-8",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: ' . $contentType,
                ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new WebsiteNotFoundException($err);
        } else {
            return $response;
        }
    }

}