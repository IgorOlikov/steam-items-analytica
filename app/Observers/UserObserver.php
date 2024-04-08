<?php

namespace App\Observers;

use App\Models\User;



class UserObserver
{
    public function creating(User $user): void
    {
       //
    }
    /**
     * Handle the Product "created" event.
     */
    public function created(User $user): void
    {
        $cart = $user->cart()->create();

        $user['cart_id'] = $cart->id;
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
