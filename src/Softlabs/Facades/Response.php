<?php namespace Softlabs\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response as ResponseFacade;

class Response extends ResponseFacade
{
	/**
	 * Return a new JSON response from the application.
	 *
	 * @param  string|array  $data
	 * @param  int    $status
	 * @param  array  $headers
	 * @return \Illuminate\Http\JsonResponse
	 */
	public static function json($data = array(), $status = 200, array $headers = array(), $options = 0)
	{
		if ($data instanceof ArrayableInterface)
		{
			$data = $data->toArray();
		}

		// Replace the header with text/html to stop file
		// download response being triggered on IE9.
		$headers['Content-Type'] = 'text/html';

		return new JsonResponse($data, $status, $headers);
	}
}