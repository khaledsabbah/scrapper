<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/8/18
 * Time: 3:58 AM
 */

namespace App\Libs;


/**
 * Class Proxy
 * @package App\Libs
 */
abstract class Proxy
{
    /**
     * get Online Proxy Server
     * @return array
     */
    public static final function getProxyServer(): array
    {
        $regex = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}/";
        $proxyProvider = "http://aliveproxy.com/fastest-proxies/";
        $proxyHTML = file_get_contents($proxyProvider);
        preg_match_all($regex, $proxyHTML, $onlineProxyServers);
        $onlineProxyServers = array_shift($onlineProxyServers);
        $proxyIndex = array_rand($onlineProxyServers);
        $proxyServer = explode(':', $onlineProxyServers[$proxyIndex]);
        return ['server' => $proxyServer[0], 'port' => $proxyServer[1]];

    }
}