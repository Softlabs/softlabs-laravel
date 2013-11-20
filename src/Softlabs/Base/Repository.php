<?php namespace Softlabs\Base;

use Softlabs\Base\StoreInterface;

abstract class Repository
{
	/**
	 * The default repository action for retrieving an item of data.
	 *
	 * @return mixed Data
	 */
	abstract public function get();

	/**
	 * The default repository action for retrieving all data.
	 *
	 * @return mixed Data collection
	 */
	abstract public function getAll();

	/**
	 * The default repository action for storing a new item of data.
	 *
	 * @return mixed
	 */
	abstract public function create();

	/**
	 * The default repository action for updating an item of data.
	 *
	 * @return mixed
	 */
	abstract public function update();

	/**
	 * The default repository action for removing an item of data.
	 *
	 * @return mixed
	 */
	abstract public function destroy();
}