<?php

use Softlabs\Base\StoreInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent implements StoreInterface
{
    /**
     * Called when the store should retrieve an item of data.
     * @param integer $identifier The identifier of the data.
     * @return mixed Data
     */
    public function get($identifier)
    {
        parent::get($identifier);
    }

    /**
     * Called when the store should retrieve all of its data.
     * @return mixed Data collection
     */
    public function getAll()
    {
        parent::getAll();
    }

    /**
     * Called when the store should store an item of data.
     * @param mixed $data The data to store.
     * @return mixed (eg. Success boolean)
     */
    public function put($key, $data)
    {
        parent::put($key, $data);
    }

    /**
     * Called when the store should remove an item of data.
     * @param integer $identifier The identifier of the data.
     * @return mixed (eg. Success boolean)
     */
    public function remove($identifier)
    {
        parent::remove($identifier);
    }
}