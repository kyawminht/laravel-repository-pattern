<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $user=$this->userRepository->all();
        return response()->json($user);
    }


    public function store(UserRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:8',
        // ]);

        // if ($validator->fails()){
        //     return response()->json($validator->messages());
        // }

        $user=$this->userRepository->create($request->all());
        return response()->json($user);
    }


    public function show(string $id)
    {
        $user=$this->userRepository->find($id);
        return response()->json($user);
    }



    public function update(UserRequest $request, string $id)
    {
        $user=$this->userRepository->update($id,$request->all());
        return response()->json([
            $user,
            'user updated'
        ]);
    }


    public function destroy(string $id)
    {
        $user=$this->userRepository->delete($id);
        return response()->json("user deleted");
    }
}
