<?php

interface DropdownableInterface
{
	/**
	 * Called when the object should be retrieved in dropdown format.
	 * @return array The data to display in the dropdown.
	 */
	public function getForDropdown();
}