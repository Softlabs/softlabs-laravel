<?php namespace Softlabs\Pagination;

class AjaxPresenter extends Illuminate\Pagination\BootstrapPresenter
{
	/**
	 * Render the Bootstrap pagination contents.
	 *
	 * @return string
	 */
	public function render()
	{
		// The hard-coded thirteen represents the minimum number of pages we need to
		// be able to create a sliding page window. If we have less than that, we
		// will just render a simple range of page links insteadof the sliding.
		if ($this->lastPage < 13)
		{
			$content = $this->getPageRange(1, $this->lastPage);
		}
		else
		{
			$content = $this->getPageSlider();
		}

		return $this->getPrevious().$content.$this->getNext();
	}

	/**
	 * Get the previous page pagination element.
	 *
	 * @param  string  $text
	 * @return string
	 */
	public function getPrevious($text = '&laquo;')
	{
		// If the current page is less than or equal to one, it means we can't go any
		// further back in the pages, so we will render a disabled previous button
		// when that is the case. Otherwise, we will give it an active "status".
		if ($this->currentPage <= 1)
		{
			return '<li class="disabled"><span>'.$text.'</span></li>';
		}
		else
		{
			$url = $this->paginator->getUrl($this->currentPage - 1);

			$url = $this->currentPage - 1;

			return '<li><a class="pagination-control" pagination="'.$url.'"" href="#">'.$text.'</a></li>';
		}
	}

	/**
	 * Get the next page pagination element.
	 *
	 * @param  string  $text
	 * @return string
	 */
	public function getNext($text = '&raquo;')
	{
		// If the current page is greater than or equal to the last page, it means we
		// can't go any further into the pages, as we're already on this last page
		// that is available, so we will make it the "next" link style disabled.
		if ($this->currentPage >= $this->lastPage)
		{
			return '<li class="disabled"><span>'.$text.'</span></li>';
		}
		else
		{
			$url = $this->paginator->getUrl($this->currentPage + 1);

			$url = $this->currentPage + 1;

			return '<li><a class="pagination-control" pagination="'.$url.'" href="#">'.$text.'</a></li>';
		}
	}

	/**
	 * Get a pagination "dot" element.
	 *
	 * @return string
	 */
	public function getDots()
	{
		return '<li class="disabled"><span>...</span></li>';
	}

	/**
	 * Create a pagination slider link.
	 *
	 * @param  mixed   $page
	 * @return string
	 */
	public function getLink($page)
	{
		$url = $this->paginator->getUrl($page);

		return '<li><a class="pagination-control" pagination="'.$page.'" href="#">'.$page.'</a></li>';
	}
}
