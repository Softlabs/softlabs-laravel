<?php

use Softlabs\Validator\Validator;

class SampleValidator extends Validator
{
	public $rules =
	[
		'field1' => 'required'
	];

	public $messages =
	[
		'field1.required' => 'Field1 is required.'
	];
}