<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserDeleted;
use App\Events\UserRegistered;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserService
{
    public function store(array $data): User
    {
        DB::transaction(function () use ($data) {
            $this->checkTrashedUsers($data);
        });
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role'],
        ]);
        $link = (new LinkGeneratorService())->createEmailVerificationLink($user);
        UserRegistered::dispatch($user, $link);
        return $user;
    }

    public function storeClient(array $data): User
    {
        DB::transaction(function () use ($data) {
            $this->checkTrashedUsers($data);
        });
        $user = User::create([
            'role_id' => 2,
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }

    public function destroy(User $user, bool $forceDelete)
    {
        DB::transaction(function () use ($user, $forceDelete) {
            (new CommentService)->destroyUserComments($user, $forceDelete);
            (new MediaService)->destroyUserMedia($user, $forceDelete);
            (new PostService)->destroyUserPosts($user, $forceDelete);
            $forceDelete ? $user->forceDelete() : $user->delete();

            UserDeleted::dispatch($user);
        });
    }

    public function restore($user): User
    {
        return DB::transaction(function () use ($user) {
            User::withTrashed()->find($user)->restore();
            $user = User::find($user);
            (new MediaService)->restoreUserMedia($user);
            (new PostService)->restoreUserPosts($user);
            (new CommentService)->restoreUserComments($user);
            return $user;
        });
    }

    public function editDetails(array $data, Authenticatable|User $user): bool
    {
        return $user->update([
            'username' => $data['new_username'],
            'email' => $data['new_email'],
        ]);
    }

    public function editPassword(array $data, Authenticatable|User $user): bool
    {
        return $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
    }


    public function toggleTheme(): void
    {
        auth()->user()->update(['darkmode' => !auth()->user()->darkmode]);
        $theme = auth()->user()->darkmode ? 'black' : 'retro';
        session(['theme' => $theme]);
    }

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getUserList()
    {
        return User::withTrashed()->withCount(['posts', 'comments'])->with(['avatar', 'role'])->get();
    }

    private function checkTrashedUsers(array $data): void
    {
        $trashedUser = User::onlyTrashed()->where('username', $data["username"])->orWhere('email', $data['email'])->first();

        if ($trashedUser) {
            $trashedUser->comments()->forceDelete();
            $trashedUser->posts()->forceDelete();
            $trashedUser->media()->forceDelete();
            $trashedUser->forceDelete();
        }
    }

    public function getUserById(string $id): User
    {
        return User::find($id);
    }

    public function getUserByEmail($email): User
    {
        return User::whereEmail($email)->first();
    }

    public function getUserDataTable($users)
    {
        return DataTables::of($users)
            ->editColumn('username', function ($user) {
                return view('components.user-list.username', compact('user'));
            })
            ->editColumn('role_id', function ($user) {
                return ucfirst($user->role->name);
            })
            ->editColumn('updated_at', function ($user) {
                return Carbon::parse($user->created_at)->toDateTimeString();
            })
            ->editColumn('error_message', function ($user) {
                return $user->error_message ?? "_";
            })
            ->addColumn('actions', function ($user) {
                return view('components.user-list.actions', compact('user'));
            })
            ->toJson();
    }

}
