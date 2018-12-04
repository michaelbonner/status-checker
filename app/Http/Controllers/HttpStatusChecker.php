<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

class HttpStatusChecker extends Controller
{
    public function check_status(Request $request, $url = '')
    {
        if (! $url) {
            $url = $request->url;
        }

        // First you configure Guzzle with redirect tracking and make a request
        $client = new Client([
            RequestOptions::ALLOW_REDIRECTS => [
                'max'             => 10,        // allow at most 10 redirects.
                'strict'          => true,      // use "strict" RFC compliant redirects.
                'referer'         => true,      // add a Referer header
                'track_redirects' => true,
            ],
        ]);

        try {
            $res = $client->request('GET', $url, [
                'connect_timeout' => 10,
                'verify' => false
            ]);

            $redirectUriHistory = $res->getHeader('X-Guzzle-Redirect-History'); // retrieve Redirect URI history
            array_unshift($redirectUriHistory, $url);

            return [
                'url' => $url,
                'status_code' => $res->getStatusCode(),
                'redirect_path' => $redirectUriHistory,
                'headers' => $res->getHeaders()
            ];
        } catch (ClientException $e) {
            $res = $e->getResponse();
            return [
                'url' => $url,
                'status_code' => $res->getStatusCode(),
                'message' => $e->getMessage(),
                'headers' => $res->getHeaders()
            ];
        } catch (ConnectException $e) {
            return [
                'url' => $url,
                'status_code' => 504,
                'message' => $e->getMessage(),
                'headers' => []
            ];
        } catch (ServerException $e) {
            return [
                'url' => $url,
                'status_code' => 500,
                'message' => $e->getMessage(),
                'headers' => []
            ];
        } catch (RequestException $e) {
            return [
                'url' => $url,
                'status_code' => 'Reqeust Exception',
                'message' => $e->getMessage(),
                'headers' => []
            ];
        }
    }
}
