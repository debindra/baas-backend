<?php


    namespace App\Services;


    use GuzzleHttp\Client;
    use http\Env\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class VeeamAgentService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/infrastructure';

        }


        public function getBackupAgents($payload)
        {

            $token = Session::get('veeamBearerToken');

            if (! $token) $token = $this->service->getToken();

            $res = Http::withOptions(['verify' => false])->withToken($token)->get($this->url, $payload);
dd($res->body());

//            $res = $client->request('GET', $this->url, [
//                'headers' => $headers,
//                'limit' => $payload['limit'] ?? 100,
//                'offset' => $payload['offset'] ?? 0,
//
//
//            ]);

            return $res;


        }

    }
