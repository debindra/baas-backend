<?php

    namespace App\Http\Controllers;

    use App\Services\VeeamAgentService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;

    class AgentController extends Controller
    {

        public function index(Request $request, VeeamAgentService $service)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $service->getBackupAgents($payload);

            $data['rows'] = $response->body();

            return response()->json($data, 200);

        }
    }
