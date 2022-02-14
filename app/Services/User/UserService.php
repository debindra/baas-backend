<?php


    namespace App\Services\User;


    use App\Services\VeeamService;
    use http\Env\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class UserService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/users';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();

        }


        public function getUserLogins($payload)
        {
            $fullUrl = $this->url . '/logins';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl, $payload);

            return $res->object();
        }

        public function getAllUser($payload)
        {
            $fullUrl = $this->url;
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();
        }


        public function addUser($payload)
        {
            $fullUrl = $this->url;
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl, $payload);

            return $res->object();

        }


        public function getMe()
        {
            $fullUrl = $this->url . '/me';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();
        }


    }
