<?php namespace Softlabs\Base;

interface StoreInterface
{
	/**
	 * Called when the store should retrieve an item of data.
	 *
	 * @param integer $identifier The identifier of the data.
	 * @return mixed Data
	 */
	public function get($identifier);

	/**
	 * Called when the store should retrieve all of its data.
	 *
	 * @return mixed Data collection
	 */
	public function getAll();

	/**
	 * Called when the store should store an item of data.
	 *
	 * @param mixed $data The data to store.
	 * @return mixed (eg. Success boolean)
	 */
	public function put($key, $data);

	/**
	 * Called when the store should remove an item of data.
	 *
	 * @param integer $identifier The identifier of the data.
	 * @return mixed (eg. Success boolean)
	 */
	public function remove($identifier);
}