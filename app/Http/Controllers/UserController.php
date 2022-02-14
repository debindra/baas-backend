<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class UserController extends Controller
    {

        public function __construct()
        {
            $this->middleware('auth:api', ['except' => ['login', 'register']]);
        }


        public function profile()
        {
            $data = auth()->user();
            $data['roles'] = [
                [
                    "id" => 4,
                    "title" => "Super Admin",
                    "permissions" => []
                ]
            ];
            $data['modules'] = [
                [
                    "id" =>  4,
        "title" =>  "DASHBOARD",
        "icon" =>  "home",
        "path" =>  "/dashboard",
        "code" =>  "DASHBOARD",
        "order" =>  1,
        "subModules" => []
            ]

            ];

            return response()->json(['data' => $data]);
        }
    }
