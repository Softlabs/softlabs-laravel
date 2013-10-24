<?php namespace Softlabs\Base;

use StoreInterface;

abstract class Repository
{
	/**
	 * The data store to provide data for.
	 * @var StoreInterface
	 */
	protected $store;

	/**
	 * Called when the repository should construct itself.
	 * @param StoreInterface $store The data store to provide for.
	 */
	public function __construct(StoreInterface $store)
	{
		$this->store = $store;
	}

	/**
	 * The default repository action for retrieving an item of data.
	 * @param integer $identifier The identifier of the data.
	 * @return mixed Data
	 */
	public function get($identifier)
	{
		return $this->store->get($identifier);
	}

	/**
	 * The default repository action for retrieving all data.
	 * @return mixed Data collection
	 */
	public function getAll()
	{
		return $this->store->getAll();
	}

	/**
	 * The default repository action for storing an item of data.
	 * @param mixed $data The data to store.
	 * @return mixed (eg. Success boolean)
	 */
	public function put($data)
	{
		return $this->store->put($data);
	}

	/**
	 * The default repository action for removing an item of data.
	 * @param integer $identifier The identifier of the data.
	 * @return mixed (eg. Success boolean)
	 */
	public function remove($identifier)
	{
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