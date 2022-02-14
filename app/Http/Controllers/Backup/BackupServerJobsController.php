<?php

    namespace App\Http\Controllers\Backup;

    use App\Http\Controllers\Controller;
    use App\Services\Backup\BackupServerJobsService;
    use Illuminate\Http\Request;

    class BackupServerJobsController extends Controller
    {

        public function __construct(BackupServerJobsService $service)
        {
            $this->service = $service;
        }


        public function index(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->service->getBackupServers($payload);

            return response()->json($response, 200);

        }


        public function getJobsByBackupServerId($backupServerUid, Request $request)
        {
            $payload = $request->all();

            $response = $this->service->getJobsByBackupServerId($backupServerUid, $payload);

            return response()->json($response, 200);

        }


        public function getJobById($jobUid)
        {
            $response = $this->service->getJobById($jobUid);

            return response()->json($response, 200);
        }


        public function updateJob(Request $request, $jobUid)
        {
            $payload = $request->all();
            $response = $this->service->updateJob($payload, $jobUid);

            return response()->json($response, 200);

        }


        public function jobStart($jobUid)
        {
            $response = $this->service->jobStart($jobUid);

            return response()->json($response, 200);
        }

        public function jobStop($jobUid)
        {
            $response = $this->service->jobStop($jobUid);

            return response()->json($response, 200);
        }


        public function jobRetry($jobUid)
        {
            $response = $this->service->jobRetry($jobUid);

            return response()->json($response, 200);

        }

    }
