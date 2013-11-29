<?php namespace Softlabs\Base;

interface RepositoryInterface
{
	/**
	 * The default repository action for retrieving an item of data.
	 *
	 * @param  integer $identifier  The identifier of the data.
	 * @return mixed   Data
	 */
	public function get($identifier);

	/**
	 * The default repository action for retrieving all data.
	 *
	 * @return mixed Data collection
	 */
	public function getAll();

	/**
	 * The default repository action for storing a new item of data.
	 *
	 * @param  mixed  $data  The data to store.
	 * @return mixed
	 */
	public function create($data);

	/**
	 * The default repository action for updating an item of data.
	 *
	 * @param  integer $identifier  The identifier of the data.
	 * @param  mixed   $data        The data to update with.
	 * @return mixed
	 */
	public function update($identifier, $data);

	/**
	 * The default repository action for removing an item of data.
	 *
	 * @param  integer $identifier  The identifier of the data.
	 * @return mixed
	 */
	public function destroy($identifier);
}