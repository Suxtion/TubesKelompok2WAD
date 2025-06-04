<?php

namespace App\Policies;

use App\Models\CateringOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CateringOrderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, CateringOrder $cateringOrder)
    {
        return $user->id === $cateringOrder->user_id;
    }

    public function update(User $user, CateringOrder $cateringOrder)
    {
        return $user->id === $cateringOrder->user_id && $cateringOrder->status === 'pending';
    }

    public function delete(User $user, CateringOrder $cateringOrder)
    {
        return $user->id === $cateringOrder->user_id && $cateringOrder->status === 'pending';
    }
}