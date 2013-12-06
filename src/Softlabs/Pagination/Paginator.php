<?php namespace Softlabs\Pagination;

class Paginator
{
	/**
	 * A model to retrieve data to paginate from.
	 *
	 * @var \Illuminate\Database\Eloquent\Builder
	 */
	protected $model;

	/**
	 * The name of the column to sort.
	 *
	 * @var string
	 */
	protected $sortColumn;

	/**
	 * The order to sort the column (eg. asc/desc)
	 *
	 * @var string
	 */
	protected $sortOrder;

	/**
	 * Called when the paginator should construct itself.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder  $model
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

	/**
	 * Called when ajax pagination should be carried out.
	 *
	 * @param  integer  $amount
	 * @param  integer  $page
	 * @return array
	 */
	public function ajaxPaginate($amount, $page = 1)
	{
		self::retrieveInput();

		// Start by setting Laravel's paginator environment
		// to the specified page.
		\Paginator::setCurrentPage($page);

		$users = self::applyFilters()->paginate($amount);

		$view = \View::make('users', compact('users'))->render();

		return [
			'status' => 'ok',
			'view' => $view,
			'sort_column' => $this->sortColumn,
			'sort_order' => $this->sortOrder
		];
	}

	/**
	 * Retrieves all of the relevant session variables.
	 *
	 * @return void
	 */
	protected function retrieveInput()
	{
		// The sort column is the column which has been
		// selected to be sorting.
		$this->sortColumn = \Input::get('sort_column');

		// The sort order is the order in which the sort
		// column should be sorted. (asc/desc)
		$this->sortOrder = \Input::get('sort_order');
	}

	/**
	 * Applies filtering to models.
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	protected function applyFilters()
	{
		$relationships = self::findRelationships($this->sortColumn);

		// If relationships were found on this model, we
		// will create a related model before we begin
		// applying filters.
		if ( ! empty($relationships)) {
			$model = self::makeRelatedModel($relationships);
		}

		// Otherwise we can directly use the model instance.
		else {
			$model = $this->model;
		}

		// < TODO > //
		if ((count(explode('.', $this->sortColumn)) > 1) or ! isset($this->sortColumn))  {
			return $model;
		}

		$model = $model->orderBy($this->sortColumn, $this->sortOrder);

		// // The sort column and sort order is used to interact
		// // with the 'orderBy' sorting of the data.
		// if (isset($this->sortColumn) and isset($this->sortOrder)) {
		// 	$model = $model->orderBy($this->sortColumn, $this->sortOrder);
		// }

		return $model;
	}

	protected function findRelationships($content)
	{
		$relationships = explode('.', $content);

		// If there are no relationships required to sort
		// this column, we can stop here.
		if (count($relationships) <= 1) {

			return;
		}

		// The first item determines the base model to find
		// relationships in, and the final item determines
		// the field to sort by.
		$base = head($relationships);
		$field = last($relationships);

		unset($relationships[0]);
		unset($relationships[count($relationships)]);

		return $relationships;
	}

	protected function makeRelatedModel($relationships)
	{
		$chain = $this->model;

		// Iterate each relationship detected so that
		// we can chain on/include the appropriate
		// fields.
		foreach ($relationships as $relationship) {
			$name = \Str::title($relationship);

			$models[] = $chain->with($name);
		}

		return $chain;
	}
}