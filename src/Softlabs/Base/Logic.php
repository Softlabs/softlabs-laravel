<?php namespace Softlabs\Base;

use Softlabs\Base\Repository;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Application as App;
use Illuminate\Support\Facades\Facade;

abstract class Logic
{
	/**
	 * The repository used to provide data to work logic on.
	 *
	 * @var Softlabs\Base\Repository
	 */
	protected $repository;
}