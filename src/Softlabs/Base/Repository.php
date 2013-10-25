<?php namespace Softlabs\Base;

use StoreInterface;
use Softlabs\Base\Exception;

abstract class Repository implements StoreInterface
{
	/**
	 * The data store to provide data for.
	 * @var StoreInterface
	 */
	protected $store;

	/**
	 * Specify whether null is allowed to be stored with this
	 * repository.
	 * @var boolean
	 */
	protected $allowPutNull = false;

	/**
	 * Called when the repository should construct itself.
	 * @param StoreInterface $store The data store to provide for.
	 */
	public function __construct(StoreInterface $store)
	{
		if (get_class($store) === get_class(self)) {
			throw new InvalidArgumentException(
				'You cannot use a repository as a repository store.'
			);
		}

		$this->store = $store;
	}

	/**
	 * Checks if a data store has been set for this repository.
	 * @param  boolean $throwException Specifies whether an exception
	 * should be thrown if the store is non-existent.
	 * @return boolean If the store exists or not
	 */
	private function checkStoreExists($throwException = true)
	{
		if ($throwException) {
			if ( ! isset($this->store)) {
				throw new NoStoreSetException(
					'A data store has not been set for this repository.'
				);
			}
		}

		return isset($this->store);
	}

	/**
	 * The default repository action for retrieving an item of data.
	 * @param integer $identifier The identifier of the data.
	 * @return mixed Data
	 */
	public function get($identifier)
	{
		$this->checkStoreExists();

		return $this->store->get($identifier);
	}

	/**
	 * The default repository action for retrieving all data.
	 * @return mixed Data collection
	 */
	public function getAll()
	{
		$this->checkStoreExists();

		return $this->store->getAll();
	}

	/**
	 * The default repository action for storing an item of data.
	 * @param mixed $data The data to store.
	 * @return mixed (eg. Success boolean)
	 */
	public function put($data)
	{
		if ( ! $allowPutNull and is_null($data)) {
			throw new \InvalidArgumentException(
				'A null value was attempted to be stored.'
			);
		}

		$this->checkStoreExists();

		return $this->store->put($data);
	}

	/**
	 * The default repository action for removing an item of data.
	 * @param integer $identifier The identifier of the data.
	 * @return mixed (eg. Success boolean)
	 */
	public function remove($identifier)
	{
		if (is_null($identifier) or empty($identifier)) {
			throw new \InvalidArgumentException(
				'No identifier was specified to remove data.'
			);
		}

		return $this->store->remove($identifier);
	}

	/**
	 * Called when any unknown method calls are made to the repository.
	 * @return mixed Attempt the method call on the data store.
	 */
	public function __call($method, $parameters)
	{
		return call_user_func_array(array($this->store, $method), $parameters);
	}
}