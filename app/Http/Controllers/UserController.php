<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Exports\UserExport;
use App\Http\Requests\Posts\StoreUserRequest;
use App\Http\Requests\User\EditUserDetailsRequest;
use App\Imports\UserImport;
use App\Models\User;
use App\Notifications\DetailsChangedNotification;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function dataTable()
    {
        $users = $this->userService->getUserList();
        return $this->userService->getUserDataTable($users);
    }

    public function index()
    {
        return view('pages.admin.users');
    }

    public function create()
    {
        return view('pages.admin.access');
    }


    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $user = $this->userService->store($request->validated());
            return back()->with('success', 'User ' . $user->name . ' created successfully.');
        } catch (Exception $e) {
            return back()->with('error', "User '. $user->name .' could not be created." . $e->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->userService->destroy($user, false);
            return back()->with('success', 'User ' . $user->name . ' deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'User ' . $user->name . ' could not be deleted.');
        }
    }

    public function forceDestroy(User $user): RedirectResponse
    {
        try {
            $this->userService->destroy($user, true);
            return back()->with('success', 'User ' . $user->name . ' force deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'User ' . $user->name . ' could not be force deleted.' . $e->getMessage());
        }
    }


    public function restore($user): RedirectResponse
    {
        try {
            $user = $this->userService->restore($user);
            return back()->with('success', 'User with email ' . $user->email . ' restored successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'User ' . $user->name . ' could not be restored');
        }
    }

    public function edit(EditUserDetailsRequest $request, User $user): RedirectResponse
    {
        try {
            if ($this->userService->editDetails($request->validated(), $user)) {
                $user->notify(new DetailsChangedNotification($user));
            }
            return back()->with('success', 'User ' . $user->name . ' details updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'User ' . $user->name . ' details could not be updated.');
        }
    }

    public function export()
    {
        try {
            return Excel::download(new UserExport, 'users_' . now()->format('d-m-y') . '.xlsx');
        } catch (Exception $e) {
            return back()->with('error', 'User/s could not be exported');
        }
    }

    public function import()
    {
        try {

            Excel::import(new UserImport, request()->userData);
            return redirect(route('user_list'))->with('success', 'New User/s created from import.');
        } catch (ValidationException $e) {
            foreach ($e->failures() as $failure) {
                foreach ($failure->errors() as $error)
                    $errors[] = 'Row ' . $failure->row() . ": " . $error;
            }
            return back()->with('errors', $errors);
        }
    }

    public function example()
    {
        $file= public_path(). "/storage/examples/users.xlsx";
        return Response::download($file, 'user_import_example.xlsx');
    }
}
