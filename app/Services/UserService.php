<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserDeleted;
use App\Events\UserRegistered;
use App\Notifications\DetailsChangedNotification;
use App\Notifications\PasswordChangedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserService
{
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $this->checkTrashedUsers($data);
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
        $user = User::create([
            'role_id' => $data['role'],
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $link = (new LinkGeneratorService())->createEmailVerificationLink($user);
        UserRegistered::dispatch($user, $link);
        return $user;
    }

    public function storeClient(array $data)
    {
        try {
            DB::beginTransaction();
            $this->checkTrashedUsers($data);
            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
        $user = User::create([
            'role_id' => 2,
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $link = (new LinkGeneratorService())->createEmailVerificationLink($user);
        UserRegistered::dispatch($user, $link);

        return $user;
    }

    public function destroy(User $user, bool $forceDelete = false)
    {
        try {
            DB::beginTransaction();

            (new CommentService)->destroyUserComments($user, $forceDelete);
            (new MediaService)->destroyUserMedia($user, $forceDelete);
            (new PostService)->destroyUserPosts($user, $forceDelete);
            $forceDelete ? $user->forceDelete() : $user->delete();

            UserDeleted::dispatch($user);

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
    }

    public function restore($user)
    {
        try {
            DB::beginTransaction();

            User::withTrashed()->find($user)->restore();

            $user = User::find($user);
            (new MediaService)->restoreUserMedia($user);
            (new PostService)->restoreUserPosts($user);
            (new CommentService)->restoreUserComments($user);

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
    }

    public function editDetails(array $data, User $user)
    {
        if ($user->update(['username' => $data['new_username'], 'email' => $data['new_email']])) {
            $user->notify(new DetailsChangedNotification($user));
        }
    }

    public function editPassword(array $data, User $user)
    {
        if ($user->update(['password' => Hash::make($data['new_password'])])) {
            $user->notify(new PasswordChangedNotification($user));
        }
    }


    public function toggleTheme()
    {
        auth()->user()->update(['darkmode' => !auth()->user()->darkmode]);
        $theme = auth()->user()->darkmode ? 'black' : 'retro';
        session(['theme' => $theme]);
    }

    public function getUserList()
    {
        return User::SortedUserList()->paginate(10);
    }


    private function checkTrashedUsers(array $data)
    {
        $trashedUser = User::onlyTrashed()->where('username', $data["username"])->orWhere('email', $data['email'])->first();

        if ($trashedUser) {
            $trashedUser->comments()->forceDelete();
            $trashedUser->posts()->forceDelete();
            $trashedUser->media()->forceDelete();
            $trashedUser->forceDelete();
        }
    }

}
