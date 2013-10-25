<?php namespace Softlabs\Base;

use Repository;
use Illuminate\Support\Collection;

abstract class Logic
{
	/**
	 * The repository collection used to provide data to work logic on.
	 * @var Illuminate\Support\Collection
	 */
	protected $repositories;

	/**
	 * Called when the logical class should construct itself.
	 * @param Illuminate\Support\Collection $repositories
	 * A collection of repositories to work logic on.
	 * used to provide data work logic on.
	 */
	public function __construct(Collection $repositories)
	{
		foreach ($repositories as $repository) {
			if ( ! ($repository instanceof Repository)) {
				throw new InvalidArgumentException(
					'The collection specified must contain only repositories.'
				);
			}
		}

		$this->repositories = $repositories;
	}

	/**
	 * Called when unknown properties are attempted to be accessed in the
	 * logic class.
	 * @param  string $key The property being attempted to index.
	 * @return mixed Attempt to index property in repository collection.
	 */
	public function __get($key)
	{
		if ( isset($repositories[$key])) {
			return $repositories[$key];
		}
	}
}