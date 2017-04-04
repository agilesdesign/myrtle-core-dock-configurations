<?php

namespace Myrtle\Core\Configurations\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy {

	use HandlesAuthorization;

	/**
	 * Create a new policy instance.
	 *
	 * @param \App\Models\User $user
	 */
	public function __construct()
	{
		//
	}

	public function admin(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key)
		{
			return $ability->name === 'configurations.admin';
		});
	}

	public function app(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user)
		{
			return $ability->name === 'configurations.app.edit' || $this->admin($user);
		});
	}

	public function session(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user)
		{
			return $ability->name === 'configurations.session.edit' || $this->admin($user);
		});
	}

	public function any(User $user)
	{
		return $this->app($user) || $this->session($user);
	}
}
