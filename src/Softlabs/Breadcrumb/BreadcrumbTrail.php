<?php namespace Softlabs\Breadcrumb;

class BreadcrumbTrail
{
	public $trail;

	/**
	 * Called when the BreadcrumbTrail should construct itself.
	 */
	public function __construct()
	{
		$this->trail = [];
	}

	/**
	 * Retrieves the breadcrumbs in array format.
	 * @return array An array of breadcrumbs.
	 */
	public function toArray()
	{
		$newTrail = ['section' => []];

		$i = 0;
		foreach ($this->trail as $key => $crumb)
		{
			if ($i < count($this->trail) - 1) {
				$newTrail['section'][] = [
					'title' => $crumb->title,
					'link' => $crumb->link
				];

				$i++;
			}
			else {
				$finalItem = $this->trail[count($this->trail) - 1];

				$newTrail['page'] = $finalItem->title;
			}
		}

		return $newTrail;
	}

	/**
	 * Adds a breadcrumb to the trail.
	 */
	private function addOne($crumb)
	{
		if ($this->verify($crumb)) {
			$this->trail[] = $crumb;
		}
	}

	/**
	 * Adds a breadcrumb to the trail.
	 * @param Breadcrumb/array $crumb A breadcrumb
	 * @return array An array containing the updated trail
	 */
	public function add($crumb)
	{
		// Check if a breadcrumb instance was supplied.
		if ($crumb instanceof Breadcrumb) {
			$this->addOne($crumb);
		}

		// Otherwise an array should have been passed.
		elseif (is_array($crumb)) {
			foreach($crumb as $crumbItem) {
				$this->add($crumbItem);
			}
		}

		return $this;
	}

	/**
	 * Removes all breadcrumbs with the matching title.
	 * @param  string $title The title to match.
	 * @return BreadcrumbTrail The updated breadcrumb trail.
	 */
	public function remove($title)
	{
		foreach ($this->trail as $key => $crumb) {
			if ($crumb->title == $title) {
				unset($this->trail[$key]);
			}
		}

		return $this;
	}

	/**
	 * Verifies that the specified breadcrumb is valid for use.
	 * @param  Breadcrumb $crumb The breadcrumb to verify.
	 * @return Boolean   If the breadcrumb is valid.
	 */
	public function verify($crumb)
	{
		if ($crumb instanceof Breadcrumb) {
			return $crumb->verify();
		}

		return false;
	}
}