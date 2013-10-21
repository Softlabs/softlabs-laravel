<?php namespace Softlabs\Breadcrumb;

class Breadcrumb
{
	public $title;
	public $link;

	/**
	 * Called when the breadcrumb should construct itself.
	 */
	public function __construct($title=null, $link=null)
	{
		$this->title = $title;
		$this->link = $link;
	}

	/**
	 * Sets the title of the breadcrumb.
	 * @param string $title The title of the breadcrumb.
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Sets the link of the breadcrumb.
	 * @param string $link The link of the breadcrumb.
	 */
	public function setLink($link)
	{
		$this->link = $link;
	}

	/**
	 * Verifies the breadcrumb is valid.
	 * @return boolean Is breadcrumb valid.
	 */
	public function verify()
	{
		if (empty($this->title)) {
			throw new InvalidBreadcrumbException(
				"The breadcrumb '$breadcrumb' is not valid."
			);
		}
	}

	/**
	 * Called when the class should be retrieved in string format.
	 * @return string Description of the breadcrumb.
	 */
	public function __tostring()
	{
		return "[Title: '$title', Link: '$link']";
	}
}