<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HotelPoilcy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return auth()->user()->can_view_hotel;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hotel $hotel): bool
    {
        //
        return auth()->user()->can_view_hotel;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return auth()->user()->can_add_hotel;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hotel $hotel): bool
    {
        //
        return auth()->user()->can_edit_hotel;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hotel $hotel): bool
    {
        //
        return auth()->user()->can_delete_hotel;
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hotel $hotel): bool
    {
        //
        return auth()->user()->can_delete_hotel;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hotel $hotel): bool
    {
        //
        return auth()->user()->can_delete_hotel;
    }
}
