<?php

namespace App\Http\Controllers\Api;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request, $id) : JsonResponse
    {
        $user = User::find($id);

        if ($user) {
            if ($request->user()->cannot('update', $user)) {
                return response()->json([
                    'message' => 'Access denied',
                ]);
            }

            $this->validate($request, [
                'name' => 'string|max:50',
                'password' => 'string|min:6|confirmed',
            ]);

            $user->name = $request['name'];
            $user->password = Hash::make($request['password']);
            $user->image = Helper::handleUpload($request);
            $user->save();
        } else {
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'message' => 'Saved successfully',
        ]);
    }
}
