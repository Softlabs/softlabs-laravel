<?php namespace Softlabs\Base;

interface RepositoryInterface
{
	/**
	 * Called when the repository should retrieve an item of data.
	 *
	 * @param  integer  $identifier
	 * @return mixed
	 */
	public function get($identifier);

	/**
	 * Called when the repository should retrieve all data.
	 *
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Called when the repository should store a new item of data.
	 *
	 * @param  mixed  $data
	 * @return mixed
	 */
	public function create($data);

	/**
	 * Called when the repository should update an item of data.
	 *
	 * @param  integer  $identifier
	 * @param  mixed  $data
	 * @return mixed
	 */
	public function update($identifier, $data);

	/**
	 * Called when the repository should remove an item of data.
	 *
	 * @param  integer  $identifier
	 * @return mixed
	 */
	public function destroy($identifier);
}