<?php namespace Softlabs\Facades;

use Illuminate\Support\Facades\Facade;

class SLUtil extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'softlabs.util'; }

}