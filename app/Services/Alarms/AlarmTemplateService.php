<?php


    namespace App\Services\Alarms;


    use App\Services\VeeamService;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class AlarmTemplateService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/alarms';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();

        }


        public function getAllTemplate($payload)
        {
            $fullUrl = $this->url . '/templates';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();
        }


        public function getAlarmTemplateById($alarmUid)
        {
            $fullUrl = $this->url . "templates/$alarmUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();
        }


        public function deleteAlarmTemplate($alarmUid)
        {
            $fullUrl = $this->url . "templates/$alarmUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->delete($fullUrl);

            return $res->object();

        }


        public function alarmTemplateClone($alarmUid, $payload)
        {
            $fullUrl = $this->url . "templates/$alarmUid/clone";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl, $payload);

            return $res->object();

        }


        public function getAlarmEvents($alarmUid,$payload)
        {
            $fullUrl = $this->url . "templates/$alarmUid/events";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();
        }

    }
