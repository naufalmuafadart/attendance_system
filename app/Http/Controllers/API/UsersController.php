<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\UseCases\Users\GetUsersAndTheirPositionUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $getUsersAndTheirPositionUseCase;
    public function __construct(GetUsersAndTheirPositionUseCase $getUsersAndTheirPositionUseCase) {
        $this->getUsersAndTheirPositionUseCase = $getUsersAndTheirPositionUseCase;
    }

    public function index() {
        $data = User::all();

        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);
        }else{
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|confirmed|min:6'
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);
            $users = User::create($validatedData);
            $data = User::where('id', $users->id);

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch(Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function get_users_and_their_position(Request $request) {
        try {
            $data = $this->getUsersAndTheirPositionUseCase->execute();
            return ApiFormatter::createApi(200, 'Success get users and their position', $data);
        } catch (Exception $e) {
            if ($e instanceof CustomException) {
                return ApiFormatter::createApi($e->getCode(), $e->getMessage());
            }
            return ApiFormatter::createApi(400, 'Internal Server Error');
        }
    }
}
