<?php

namespace FriendsOfRedaxo\ServiceBw;

use Exception;
use rex_addon;
use rex_config;
use rex_file;
use rex_path;
use rex_socket;

class Api
{
    public const API_URL = 'sgw.service-bw.de';
    public const CacheTime = 3600 * 48; // 2 Tage

    private static function getGebietsAG()
    {
        return rex_config::get('service_bw', 'gebiet_ags', '');
    }

    private static function getGebietsID()
    {
        return rex_config::get('service_bw', 'gebiet_id', '');
    }

    public static function getBearerToken(): ?string
    {
        $addon = rex_addon::get('service_bw');
        $config = rex_config::get($addon->getName());

        if (isset($config['bearer']) && !empty($config['bearer'])) {
            return $config['bearer'];
        }
        return null;
    }

    public static function requestLebenslageById(int $id): ?array
    {
        $bearerToken = self::getBearerToken();
        if (!$bearerToken) {
            return null;
        }

        // write in cache folder
        $cacheFile = rex_path::addonCache('service_bw', 'lebenslage_' . $id . '.json');
        if (file_exists($cacheFile) && filemtime($cacheFile) > time() - self::CacheTime) {
            $cachedData = file_get_contents($cacheFile);
            if ($cachedData) {
                return json_decode($cachedData, true);
            }
        }

        $socket = rex_socket::factory(self::API_URL, 443, true);
        $socket->setPath('/rest-v2/api/portal/lebenslagendetails/' . $id . '?mandantId=cillum%20exercitation&gebietAgs=' . self::getGebietsAG() . '&gebietId=' . self::getGebietsID() . '&urlTemplateLebenslagen=cillum%20exercitation&urlTemplateLeistungen=cillum%20exercitation');

        $socket->addHeader('Authorization', 'Bearer ' . $bearerToken);
        $socket->acceptCompression();
        $socket->setTimeout(10); // Set a timeout for the request
        try {
            $response = $socket->doGet();
        } catch (Exception $e) {
            return null;
        }

        if (!$response->isOk()) {
            return null;
        }

        rex_file::put($cacheFile, $response->getBody());

        return json_decode($response->getBody(), true) ?? null;
    }

    public static function requestLebenslagen(): ?array
    {
        $bearerToken = self::getBearerToken();
        if (!$bearerToken) {
            return null;
        }

        // write in cache folder
        $cacheFile = rex_path::addonCache('service_bw', 'lebenslagen.json');
        if (file_exists($cacheFile) && filemtime($cacheFile) > time() - self::CacheTime) {
            $cachedData = file_get_contents($cacheFile);
            if ($cachedData) {
                return json_decode($cachedData, true);
            }
        }

        $socket = rex_socket::factory(self::API_URL, 443, true);
        $socket->setPath('/rest-v2/api/lebenslagen/lebenslagenbaum?mandantId=cillum%20exercitation&gebietAgs=' . self::getGebietsAG() . '&gebietId=' . self::getGebietsID() . '&ebenen=-11687999&page=0&pageSize=1000&sortDirection=asc&sortProperty=name');
        $socket->addHeader('Authorization', 'Bearer ' . $bearerToken);
        $socket->acceptCompression();
        $socket->setTimeout(10); // Set a timeout for the request
        try {
            $response = $socket->doGet();
        } catch (Exception $e) {
            return null;
        }

        if (!$response->isOk()) {
            return null;
        }

        rex_file::put($cacheFile, $response->getBody());

        return json_decode($response->getBody(), true) ?? null;
    }

    public static function requestDienstleistungById(int $id): ?array
    {
        $bearerToken = self::getBearerToken();
        if (!$bearerToken) {
            return null;
        }

        // write in cache folder
        $cacheFile = rex_path::addonCache('service_bw', 'dienstleistungen_' . $id . '.json');
        if (file_exists($cacheFile) && filemtime($cacheFile) > time() - self::CacheTime) {
            $cachedData = file_get_contents($cacheFile);
            if ($cachedData) {
                return json_decode($cachedData, true);
            }
        }

        $socket = rex_socket::factory(self::API_URL, 443, true);
        $socket->setPath('/rest-v2/api/portal/leistungsdetails/' . $id . '?gebietAgs=' . self::getGebietsAG() . '&gebietId=' . self::getGebietsID() . '');

        $socket->addHeader('Authorization', 'Bearer ' . $bearerToken);
        $socket->acceptCompression();
        $socket->setTimeout(10); // Set a timeout for the request
        try {
            $response = $socket->doGet();
        } catch (Exception $e) {
            return null;
        }

        if (!$response->isOk()) {
            return null;
        }

        rex_file::put($cacheFile, $response->getBody());

        return json_decode($response->getBody(), true) ?? null;
    }

    public static function requestDienstleistungen(): ?array
    {
        $bearerToken = self::getBearerToken();
        if (!$bearerToken) {
            return null;
        }

        // write in cache folder
        $cacheFile = rex_path::addonCache('service_bw', 'dienstleistungen.json');
        if (file_exists($cacheFile) && filemtime($cacheFile) > time() - self::CacheTime) {
            $cachedData = file_get_contents($cacheFile);
            if ($cachedData) {
                return json_decode($cachedData, true);
            }
        }

        $socket = rex_socket::factory(self::API_URL, 443, true);
        $socket->setPath('/rest-v2/api/leistungen?gebietAgs=' . self::getGebietsAG() . '&gebietId=' . self::getGebietsID() . '&page=0&pageSize=1000&sortDirection=asc&sortProperty=name');
        $socket->addHeader('Authorization', 'Bearer ' . $bearerToken);
        $socket->acceptCompression();
        $socket->setTimeout(10); // Set a timeout for the request
        try {
            $response = $socket->doGet();
        } catch (Exception $e) {
            return null;
        }

        if (!$response->isOk()) {
            return null;
        }

        rex_file::put($cacheFile, $response->getBody());

        return json_decode($response->getBody(), true) ?? null;
    }
}
