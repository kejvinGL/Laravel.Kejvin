<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StoreUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function all(Request $request)
    {
        return User::all();
    }

    public function index()
    {
        $data = $this->userService->getUserList();
        return view('pages.users', ['users' => $data]);
    }

    public function create()
    {
        return view('pages.access');
    }

    public function new(StoreUserRequest $request)
    {
        $user = User::create([
            'role_id' => $request['role'],
            'username' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $this->userService->store($request->validated());
            return back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', "User could not be created." . $e->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->userService->destroy($user, false);
            return back()->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User could not be deleted.');
        }
    }

    public function forceDestroy(User $user): RedirectResponse
    {
        try {
            $this->userService->destroy($user, true);
            return back()->with('success', 'User force deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User could not be force deleted.' . $e->getMessage());
        }
    }


    public function restore($user): RedirectResponse
    {
        try {
            $this->userService->restore($user);
            return back()->with('success', 'User restored successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User could not be restored');
        }
    }

    public function edit(EditUserRequest $request, User $user): RedirectResponse
    {
        try {
            $this->userService->editDetails($request->validated(), $user);
            return back()->with('success', 'User details updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User details could not be updated.');
        }
    }
}
