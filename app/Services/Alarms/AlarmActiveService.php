<?php

    namespace App\Services\Alarms;


    use App\Services\VeeamService;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class AlarmActiveService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/alarms';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();

        }


        public function getAllActive($payload)
        {
            $fullUrl = $this->url . '/active';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);
            return $res->object();
        }


        public function getActiveById($activeAlarmUid)
        {
            $fullUrl = $this->url . "/active/$activeAlarmUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();
        }


        public function deleteActiveById($activeAlarmUid)
        {
            $fullUrl = $this->url . "/active/$activeAlarmUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->delete($fullUrl);

            return $res->object();

        }


        public function activeResolve($activeAlarmUid, $payload)
        {
            $fullUrl = $this->url . "/active/$activeAlarmUid/resolve";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl, $payload);

            return $res->object();
        }

        public function activeAcknowledge($activeAlarmUid, $payload)
        {
            $fullUrl = $this->url . "/active/$activeAlarmUid/acknowledge";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl, $payload);

            return $res->object();
        }


    }
