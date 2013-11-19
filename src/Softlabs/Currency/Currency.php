<?php namespace Softlabs\Currency;

class Currency
{
	/**
	 * Converts a value to a presentable GBP format.
     *
	 * @param  integer $data The data to be converted to GBP format.
	 * @param  string $returnVal A value to return if the conversion is impossible.
	 * @return string The formatted GBP string.
	 */
    public function gbp($data, $returnVal='-')
    {
        if (is_null($data)) {
            return $returnVal;
        }

        if ( ! is_float($data)) {
        	$data = floatval($data);
        }

        return (is_numeric($data) ? '£' . number_format($data, 2) : $data);
    }
}