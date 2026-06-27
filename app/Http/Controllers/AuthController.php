<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @group   Authentication
 */
class AuthController extends Controller
{
    /**
     * Login
     *
     * To get access token.
     *
     * @bodyParam   email           string      required    User email. Example: najmuddin@gmail.com
     * @bodyParam   password        string      required    User password. Example: najmuddin@1
     *
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "token": "6|8edWLXRg4dQp1lhMf7rEW30vB9Zb0c4IEUgRAnNge0d7f209",
     *         "user": {
     *             "first_name": "Najmuddin",
     *             "last_name": "Razali",
     *             "email": "najmuddin@gmail.com"
     *         }
     *     }
     * }
     */
    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'exists:App\Models\User,email',
            ],
            'password' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($user) {
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('Invalid email or password');
                    }
                },
            ]
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), $validator->errors());
        }

        $token = $user->createToken($request->email);

        return $this->responseSuccess('OK', [
            'token' => $token->plainTextToken,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * User Profile
     *
     * @authenticated
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "first_name": "Najmuddin",
     *             "last_name": "Razali",
     *             "email": "najmuddin@gmail.com"
     *         }
     *     ]
     * }
     */
    public function getUser(Request $request)
    {
        return $this->responseSuccess('OK', [
            new UserResource($request->user())
        ]);
    }
}
