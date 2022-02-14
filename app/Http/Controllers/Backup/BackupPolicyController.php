<?php

    namespace App\Http\Controllers;

    use App\Services\Backup\BackupPoliciesService;
    use Illuminate\Http\Request;

    class BackupPolicyController extends Controller
    {


        public function __construct(BackupPoliciesService $service)
        {
            $this->service = $service;
        }

        public function index(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->service->getBackupPolicies($payload);

            return response()->json($response, 200);
        }


        public function getBackupPoliciesToAssign(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->service->getBackupPoliciesToAssign($payload);

            return response()->json($response, 200);

        }
    }
