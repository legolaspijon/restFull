<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * User repo
     * @var UserRepository
     */
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Store user
     * @param UserFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(UserFormRequest $request)
    {
        $user = $this->userRepository->create($request->all());

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 201);
    }

    /**
     * Update user by id
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        if (!$this->userRepository->update($request->all(), $user)) {
            throw new ModelNotFoundException();
        }

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);
    }

    /**
     * Delete user by id
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user)
    {
        try {
            $this->userRepository->delete($user);

            return response([
                'status' => 'ok',
                'data' => $user
            ], 200)->json();

        } catch (\Exception $e) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * Show user by id
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        if (!$user) {
            throw new ModelNotFoundException();
        }

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);
    }

    /**
     * Get all users
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $users = $this->userRepository->all();

        return response()->json([
            'status' => 'ok',
            'data' => $users
        ], 200);
    }

    /**
     * @param string $q
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($q)
    {
        $users = $this->userRepository->search($q);

        return response()->json([
            'status' => 'ok',
            'data' => $users
        ]);
    }

}
