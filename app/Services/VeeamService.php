<?php

    namespace App\Services;


    use GuzzleHttp\Client;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class VeeamService
    {


        public function getToken()
        {
            $url = env('VEEAM_BASE_URL') . '/token';

            try
            {
                $query = [
                    'grant_type' => 'password',
                    'username' => env('VEEAM_USER_NAME'),
                    'password' => env('VEEAM_PASSWORD')

                ];

                $res = Http::withOptions(['verify' => false])->asForm()->post($url, $query);

                $token = json_decode($res->getBody()->getContents())->access_token;

                Session::put('veeamBearerToken', $token);

                return $token;
            } catch (\Exception $e)
            {
                dd($e);
            }

        }

    }
