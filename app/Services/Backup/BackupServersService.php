<?php


    namespace App\Services\Backup;


    use App\Services\VeeamService;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class BackupServersService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/infrastructure';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();

        }


        public function getBackupServers($payload)
        {
            $fullUrl = $this->url . '/backupServers';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();

        }

        public function getBackupServersById($backupServerUid)
        {
            $fullUrl = $this->url . "/backupServers/$backupServerUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();

        }


        public function backupServersCollect($backupServerUid)
        {

            $fullUrl = $this->url . "/backupServers/$backupServerUid/collect";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl);

            return $res->object();

        }


        public function getBackupServerRepository($payload)
        {
            $fullUrl = $this->url . "/backupServers/repositories";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();

        }


        public function getBackupServerByIdRepository($backupServerUid)
        {
            $fullUrl = $this->url . "/backupServers/$backupServerUid/repositories";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();

        }

        public function getBackupServerByIdRepositoryById($backupServerUid, $repositoryUid)
        {
            $fullUrl = $this->url . "/backupServers/$backupServerUid/repositories/$repositoryUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();


        }


        public function getBackupServerProxy($payload)
        {
            $fullUrl = $this->url . "/backupServers/proxies";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();

        }


        public function getBackupServerIdProxy($backupServerUid)
        {
            $fullUrl = $this->url . "/backupServers/$backupServerUid/proxies";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();

        }


        public function getBackupServerServers($payload)
        {
            $fullUrl = $this->url . "/backupServers/servers";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();

        }


    }
