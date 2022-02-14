<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use App\Services\User\UserService;
    use Illuminate\Http\Request;

    class VeeamUserController extends Controller
    {

        public function __construct(UserService $service)
        {
            $this->service = $service;
        }

        public function index(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->service->getAllUser($payload);

            return response()->json($response, 200);
        }


        public function getUserLogins(Request $request)
        {
            $payload['limit'] = $request->limit ?? 100;
            $payload['offset'] = $request->offset ?? 0;
            $response = $this->service->getUserLogins($payload);

            return response()->json($response, 200);

        }


        public function addUser(Request $request)
        {
            //TODO add validation later

            $payload = $request->all();
            $response = $this->service->addUser($payload);

            return response()->json($response, 200);
        }


        public function getMe()
        {
            $response = $this->service->getMe();

            return response()->json($response, 200);

        }


    }
