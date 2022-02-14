<?php

    namespace App\Http\Controllers;

    use App\Services\Backup\BackupServersService;
    use Illuminate\Http\Request;

    class BackupServerController extends Controller
    {

        public function __construct(BackupServersService $service)
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


        public function getBackupServersById($backupServerUid)
        {
            $response = $this->service->getBackupServerByIdRepositoryById($backupServerUid);

            return response()->json($response, 200);
        }


        public function backupServersCollect($backupServerUid)
        {
            $response = $this->service->backupServersCollect($backupServerUid);

            return response()->json($response, 200);

        }


        public function getBackupServerRepository(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->getBackupServerRepository($payload);

            return response()->json($response, 200);
        }


        public function getBackupServerByIdRepository($backupServerUid)
        {
            $response = $this->service->getBackupServerByIdRepository($backupServerUid);

            return response()->json($response, 200);
        }


        public function getBackupServerByIdRepositoryById($backupServerUid, $repositoryUid)
        {
            $response = $this->service->getBackupServerByIdRepositoryById($backupServerUid, $repositoryUid);

            return response()->json($response, 200);
        }


        public function getBackupServerProxy(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->getBackupServerProxy($payload);

            return response()->json($response, 200);

        }


        public function getBackupServerIdProxy($backupServerUid)
        {
            $response = $this->getBackupServerIdProxy($backupServerUid);

            return response()->json($response, 200);

        }


        public function getBackupServerServers(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->getBackupServerServers($payload);

            return response()->json($response, 200);

        }


    }
