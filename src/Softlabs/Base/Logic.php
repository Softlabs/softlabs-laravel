<?php namespace Softlabs\Base;

use Softlabs\Base\Repository;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Application as App;
use Illuminate\Support\Facades\Facade;

abstract class Logic
{
	/**
	 * The repository used to provide data to work logic on.
	 * @var Softlabs\Base\Repository
	 */
	protected $repository;

	/**
	 * Called when the logical class should construct itself.
	 * @param Softlabs\Base\Repository $repository
	 * The repository used to provide data to work logic on.
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}
}