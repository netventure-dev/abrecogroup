<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('list roles');
    }


    /**
     * Determine whether the admin can create models.
     *
     * @param  App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create roles');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $admin->hasPermissionTo('update roles');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $admin->hasPermissionTo('delete roles');
    }
}
