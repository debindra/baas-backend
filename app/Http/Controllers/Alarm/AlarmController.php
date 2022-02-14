<?php

    namespace App\Http\Controllers\Alarm;

    use App\Http\Controllers\Controller;
    use App\Services\Alarms\AlarmActiveService;
    use App\Services\Alarms\AlarmTemplateService;
    use Illuminate\Http\Request;

    class AlarmController extends Controller
    {

        public function __construct(AlarmTemplateService $templateService, AlarmActiveService $activeService)
        {
            $this->templateService = $templateService;
            $this->activeService = $activeService;
        }

        public function index(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->templateService->getAllTemplate($payload);

            return response()->json($response, 200);
        }


        public function getAlarmTemplateById($alarmUid)
        {
            $response = $this->templateService->getAlarmTemplateById($alarmUid);

            return response()->json($response, 200);

        }


        public function deleteAlarmTemplate($alarmUid)
        {

            $response = $this->templateService->deleteAlarmTemplate($alarmUid);

            return response()->json($response, 200);

        }


        public function alarmTemplateClone(Request $request, $alarmUid)
        {
            $payload = $request->all();
            $response = $this->templateService->alarmTemplateClone($alarmUid, $payload);

            return response()->json($response, 200);
        }


        public function getAlarmEvents($alarmUid)
        {
            $response = $this->templateService->deleteAlarmTemplate($alarmUid);

            return response()->json($response, 200);
        }// end of getAlarmEvents


        public function getAllActive(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->activeService->getAllActive($payload);

            return response()->json($response, 200);

        }


        public function getActiveById($activeAlarmUid)
        {
            $response = $this->activeService->getActiveById($activeAlarmUid);

            return response()->json($response, 200);


        }

        public function deleteActiveById($activeAlarmUid)
        {
            $response = $this->activeService->deleteActiveById($activeAlarmUid);

            return response()->json($response, 200);

        }


        public function activeResolve(Request $request, $activeAlarmUid)
        {
            //TODO Add validation

            $payload = $request->all();
            $response = $this->activeService->activeResolve($payload, $activeAlarmUid);

            return response()->json($response, 200);

        }


        public function activeAcknowledge(Request $request, $activeAlarmUid)
        {
            $payload = $request->all();
            $response = $this->activeService->activeAcknowledge($payload, $activeAlarmUid);

            return response()->json($response, 200);

        }
    }
