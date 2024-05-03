<?php

namespace App\Observers;

use App\AppUsers;

class AppUsersObserver
{
    /**
     * Handle the AppUsers "created" event.
     *
     * @param  \App\AppUsers  $appUsers
     * @return void
     */
    public function created(AppUsers $appUsers)
    {
        if ($appUsers->OTP === null && $appUsers->verification == 1) {
            $appUsers->OTP = rand(100000, 999999);
        }
    }

    /**
     * Handle the AppUsers "updated" event.
     *
     * @param  \App\AppUsers  $appUsers
     * @return void
     */
    public function updated(AppUsers $appUsers)
    {
        //
    }

    /**
     * Handle the AppUsers "deleted" event.
     *
     * @param  \App\AppUsers  $appUsers
     * @return void
     */
    public function deleted(AppUsers $appUsers)
    {
        //
    }

    /**
     * Handle the AppUsers "restored" event.
     *
     * @param  \App\AppUsers  $appUsers
     * @return void
     */
    public function restored(AppUsers $appUsers)
    {
        //
    }

    /**
     * Handle the AppUsers "force deleted" event.
     *
     * @param  \App\AppUsers  $appUsers
     * @return void
     */
    public function forceDeleted(AppUsers $appUsers)
    {
        //
    }
}
