<?php

namespace Myrtle\Core\Configurations\Policies;

use App\User;
use Myrtle\Docks\ConfigurationsDock;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationsDockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user has access to Configurations Dock Administrative Routes
     *
     * @param  \App\User $user
     * @return bool
     */
    public function accessAdmin(User $user)
    {
        return $user->allPermissions->contains(function ($ability) use ($user) {
            return $ability->name === ConfigurationsDock::class . '.access-admin';
        });
    }

    /**
     * Determine if the user has Administrator privileges
     *
     * @param  \App\User $user
     * @return bool
     */
    public function admin(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.admin';
        });
    }

    /**
     * Determine if the user can edit config.app overrides
     *
     * @param  \App\User $user
     * @return bool
     */
    public function appEdit(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.app-edit';
        });
    }

    /**
     * Determine if the user can edit config.session overrides
     *
     * @param  \App\User $user
     * @return bool
     */
    public function sessionEdit(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.session-edit';
        });
    }

    /**
     * Determine if the user can edit Dock Settings
     *
     * @param  \App\User $user
     * @return bool
     */
    public function editSettings(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.edit-settings';
        });
    }

    /**
     * Determine if the user can view Dock Settings
     *
     * @param  \App\User $user
     * @return bool
     */
    public function viewSettings(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.view';
        });
    }

    /**
     * Determine if the user can edit Dock Permissions
     *
     * @param  \App\User $user
     * @return bool
     */
    public function editPermissions(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.edit-settings';
        });
    }

    /**
     * Determine if the user can view Dock Permissions
     *
     * @param  \App\User $user
     * @return bool
     */
    public function viewPermissions(User $user)
    {
        return $user->allPermissions->contains(function ($ability) {
            return $ability->name === ConfigurationsDock::class . '.view';
        });
    }
}
