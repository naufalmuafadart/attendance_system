<?php

namespace App\Infrastructures;

use App\Exceptions\CustomException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements UserRepository {
    public function getAllUserAndTheirPosition() {
        try {
            return DB::table("users")
                ->join("jabatans", "users.jabatan_id", "=", "jabatans.id")
                ->select("users.*", "jabatans.nama_jabatan")
                ->where('users.is_admin', 'user')
                ->orderBy('users.name')
                ->get();
        } catch (\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }
}
