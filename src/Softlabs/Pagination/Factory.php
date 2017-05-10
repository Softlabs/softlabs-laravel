<?php namespace Softlabs\Pagination;

use Illuminate\View\Factory;
use Softlabs\Pagination\Paginator;

class Factory
{
	/**
	 * Called when the factory should construct itself.
	 */
	public function __construct(Environment $viewEnvironment)
	{
		// Register the view namespace
		$viewEnvironment->addNamespace('softlabs.pagination', __DIR__.'/views');
	}

	/**
	 * Creates a new paginator instance.
	 *
	 * @param  \Illuminate\Eloquent\Querybuilder $model
	 * @return void
	 */
	public function make($model, $options = [])
	{
		$instance = new Paginator($model);

		return self::resolveOptions($instance, $options);
	}

	/**
	 * Resolves the options specified for creating a new paginator instance.
	 *
	 * @param  \Softlabs\Pagination\Paginator  $paginator
	 * @param  array  $options
	 * @return \Softlabs\Pagination\Paginator
	 */
	protected function resolveOptions($paginator, $options)
	{
		// Check if an itemsPerPage option was specified, and if so
		// apply this option to the paginator.
		if (isset($options['itemsPerPage'])) {

			$paginator->setItemsPerPage($options['itemsPerPage']);
		}

		// Check if a viewName option was specified, and if so
		// apply this option to the paginator.
		if (isset($options['viewName'])) {

			$paginator->setViewName($options['viewName']);
		}

		// Check if a viewVariableName option was specifie, and if so
		// apply this option to the paginator.
		if (isset($options['viewVariableName'])) {

			$paginator->setViewVariableName($options['viewVariableName']);
		}
		elseif (isset($options['viewName'])) {

			$paginator->setViewVariableName($options['viewName']);
		}

		return $paginator;
	}
}