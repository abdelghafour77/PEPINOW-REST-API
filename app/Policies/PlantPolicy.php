<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Plant;
use App\Models\User;

class PlantPolicy
{


    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 1 ||  $user->isAdmin();
    }

    public function update(User $user, Plant $plant)
    {
        return $user->id === $plant->user_id ||  $user->isAdmin();
    }

    public function delete(User $user, Plant $plant)
    {
        return $user->id === $plant->user_id ||  $user->isAdmin();
    }
}
