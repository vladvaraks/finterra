<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function index(Request $request) {
        $user = auth()->user();
        $data = User::select('id', 'name')
                    ->where('name', 'like', '%'.$request->searchItem.'%')
                    ->where('id', '<>', $user->id);
        $userCollection = new UserCollection($data->paginate(10, ['*'], 'page', $request->page));
        return $userCollection;
    }

    public function show(User $user) {
        return new UserResourse($user);
    }
}
