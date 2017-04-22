<?php

namespace qcloudcos;

class Conf {
    // Cos php sdk version number.
    const VERSION = 'v4.2.2';
    const API_COSAPI_END_POINT = 'http://region.file.myqcloud.com/files/v2/';

    // Please refer to http://console.qcloud.com/cos to fetch your app_id, secret_id and secret_key.
    const APP_ID = '1252595848';
    const SECRET_ID = 'AKIDO95ru3qG7xcRECTqZPLNVsQ3ssy6hnHs';
    const SECRET_KEY = '4FX8dEvpu5A9EUezU5mego2DUvWElabn';

    /**
     * Get the User-Agent string to send to COS server.
     */
    public static function getUserAgent() {
        return 'cos-php-sdk-' . self::VERSION;
    }

}
