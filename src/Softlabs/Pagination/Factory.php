<?php namespace Softlabs\Pagination;

use Softlabs\Pagination\Paginator;

class Factory
{
	/**
	 * Creates a new paginator instance.
	 *
	 * @param  \Illuminate\Eloquent\Querybuilder $model
	 * @return void
	 */
	public function make($model)
	{
		return new Paginator($model);
	}
}