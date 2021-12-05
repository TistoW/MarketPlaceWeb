<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function login(Request $request) {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                return $this->success($user);
            } else {
                return $this->error("Wrong password");
            }
        }
        return $this->error("User tidak di temukan");
    }

    public function register(Request $request) {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            return $this->success($user, 'selamat datang ' . $user->name);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function update(Request $request, $id) {

        $user = User::where('id', $id)->first();
        if ($user) {
            $user->update($request->all());
            return $this->success($user);
        }

        return $this->error("tidak ada user");
    }

    public function success($data, $message = "success") {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function error($message) {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
//        return response()->json([
//            'ok' => false,
//            'error_code' => 400,
//            'description' => $message
//        ], 400);
    }
}
