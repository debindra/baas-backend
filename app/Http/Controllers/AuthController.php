<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Auth;
    use Validator;

    class AuthController extends Controller
    {

        public function __construct()
        {
            $this->middleware('auth:api', ['except' => ['login', 'register']]);
        }



        public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (!$token = auth()->attempt($validator->validated())) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        }


        public function logout()
        {
            auth()->logout();
            return response()->json(['message' => 'User successfully logged out.']);
        }


        public function refresh()
        {
            return $this->respondWithToken(auth()->refresh());
        }


        protected function respondWithToken($token)
        {

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }

    }
