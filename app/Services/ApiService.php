<?php

namespace App\Services;

use App\Models\ApiKey;
use App\Models\User;


class ApiService
{

    public function store($data)
    {
        $hashedValue = md5($data['email'] . now());

        return ApiKey::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'value' => $hashedValue,
        ]);
    }

    public function destroy(ApiKey $key)
    {
        return $key->delete();
    }

    public function edit(ApiKey $key, $data)
    {
        $keyValue = md5($data['email'] . now());
        $key->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'key' => $keyValue,
        ]);
    }

    public function getApiKey($value)
    {
        return ApiKey::whereValue($value)->firstOrFail();
    }

    public function getAllKeys()
    {
        return ApiKey::latest()->paginate(10);
    }

    public function createClientToken(User $user)
    {
        return $user->createToken($user->email, ['create-post', 'delete-post', 'create-comment', 'delete-comment']);
    }

    public function createAdminToken(User $user)
    {
       return $user->createToken($user->email, ['delete-post', 'delete-comment', 'create-user', 'delete-user', 'show-users', 'show-posts', 'show-comments']);
    }
}
