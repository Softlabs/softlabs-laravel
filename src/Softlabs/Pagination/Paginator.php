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
	 * How many items to display per paginated page.
	 *
	 * @var integer
	 */
	protected $itemsPerPage;

	/**
	 * The name of the view to display paginated data on.
	 *
	 * @var string
	 */
	protected $viewName;

	/**
	 * The name of the variable containing data to display in a paginated view.
	 *
	 * @var string
	 */
	protected $viewVariableName;

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
	 * Called when the initial pagination should be carried out.
	 * (eg When the table first loads/index view)
	 *
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function initialPaginate()
	{
		return $this->getModel()->paginate(self::getItemsPerPage());
	}

	/**
	 * Called when ajax pagination should be carried out.
	 *
	 * @param  integer  $amount
	 * @param  integer  $page
	 * @return array
	 */
	public function ajaxPaginate($page = 1)
	{
		// Retrieve the request input variables and stores them.
		self::retrieveInput();

		$viewName = self::getViewName();
		$itemsPerPage = self::getItemsPerPage();
		$viewVariableName = self::getViewVariableName();

		// Start by setting Laravel's paginator environment
		// to the specified page.
		\Paginator::setCurrentPage($page);

		$model = self::applyFilters()->paginate($itemsPerPage);

		$view = \View::make($viewName, [$viewVariableName => $model])->render();

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
		$model = self::getModel();

		// // The sort column and sort order is used to interact
		// // with the 'orderBy' sorting of the data.
		if (isset($this->sortColumn) and isset($this->sortOrder)) {
			$model = $model->orderBy($this->sortColumn, $this->sortOrder);
		}

		return $model;
	}

	/**
	 * Retrieves the model.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Retrieves the items per page.
	 *
	 * @return integer
	 */
	public function getItemsPerPage()
	{
		return $this->itemsPerPage;
	}

	/**
	 * Sets the items per page.
	 *
	 * @param  integer  $itemsPerPage
	 */
	public function setItemsPerPage($itemsPerPage)
	{
		$this->itemsPerPage = $itemsPerPage;
	}

	/**
	 * Retrieves the view name.
	 *
	 * @return string
	 */
	public function getViewName()
	{
		return $this->viewName;
	}

	/**
	 * Sets the view name.
	 *
	 * @param  string  $viewName
	 */
	public function setViewName($viewName)
	{
		$this->viewName = $viewName;
	}

	/**
	 * Retrieves the view variable name.
	 *
	 * @return string
	 */
	public function getViewVariableName()
	{
		return $this->viewVariableName;
	}

	/**
	 * Sets the view variable name.
	 *
	 * @param  string  $viewVariableName
	 */
	public function setViewVariableName($viewVariableName)
	{
		$this->viewVariableName = $viewVariableName;
	}
}