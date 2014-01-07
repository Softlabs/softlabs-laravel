<?php

if ( ! function_exists('rounddown'))
{
	/**
	 * Rounds down a value accurately.
	 *
	 * @param  integer  $value
	 * @return integer
	 */
	function rounddown($value)
	{
		return floor($value * 100) / 100;
	}
}