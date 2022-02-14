<?php

    namespace App\Services\Backup;


    use App\Services\VeeamService;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class BackupServerJobsService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/infrastructure/backupServers/';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();
        }


        public function index($payload)
        {
            $fullUrl = $this->url . 'jobs';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();
        }


        public function getJobsByBackupServerId($backupServerUid, $payload)
        {
            $fullUrl = $this->url . "$backupServerUid/jobs";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();

        }

        public function getJobById($jobUid)
        {
            $fullUrl = $this->url . "jobs/$jobUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();

        }


        public function update($payload, $jobUid)
        {

            $fullUrl = $this->url . "jobs/$jobUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->patch($fullUrl, $payload);

            return $res->object();

        }

        public function jobStart($jobUid)
        {
            $fullUrl = $this->url . "jobs/$jobUid/start";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl);

            return $res->object();
        }


        public function jobStop($jobUid)
        {
            $fullUrl = $this->url . "jobs/$jobUid/stop";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl);

            return $res->object();

        }


        public function jobRetry($jobUid)
        {
            $fullUrl = $this->url . "jobs/$jobUid/retry";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl);

            return $res->object();

        }

    }
