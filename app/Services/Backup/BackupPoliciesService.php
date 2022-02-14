<?php


    namespace App\Services\Backup;


    use App\Services\VeeamService;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;

    class BackupPoliciesService
    {

        public function __construct(VeeamService $service)
        {
            $this->service = $service;
            $this->url = env('VEEAM_BASE_URL') . '/configuration';

            $this->token = Session::get('veeamBearerToken');
            if (! $this->token) $this->token = $this->service->getToken();

        }


        public function getBackupPolicies($payload)
        {
            $fullUrl = $this->url . '/backupPolicies';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();
        }


        public function getBackupPoliciesToAssign($payload)
        {

            $fullUrl = $this->url . '/backupPoliciesToAssign';
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl, $payload);

            return $res->object();


        }


        public function getBackupPoliciesById($policyUid)
        {
            $fullUrl = $this->url . "/backupPolicies/$policyUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl);

            return $res->object();

        }


        public function deleteBackupPolicies($policyUid)
        {
            $fullUrl = $this->url . "/backupPolicies/$policyUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->delete($fullUrl);

            return $res->object();

        }

        //TODO patch policy and policy copy is remaining


        public function getBackupPoliciesForDifferentOs($os, $payload)
        {
//            if ($os == 'windows')
//            {
//
//            } else if ($os == 'linux')
//            {
//
//            }

            $fullUrl = $this->url . "/backupPolicies/$os";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->get($fullUrl,$payload);

            return $res->object();


        }


        public function backupPoliciesForDifferentOs($os, $payload)
        {
            $fullUrl = $this->url . "/backupPolicies/$os";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl,$payload);

            return $res->object();

        }


        public function getBackupPoliciesByPolicyIdForDifferentOs($os, $policyUid)
        {
            $fullUrl = $this->url . "/backupPolicies/$os/$policyUid";
            $res = Http::withOptions(['verify' => false])
                ->withToken($this->token)
                ->post($fullUrl);

            return $res->object();

        }


    }
