<?php

use Softlabs\Validator\Validator;

/**
 * This test case will attempt to create a sample validator and
 * check that the correct methods and properties exist
 * within the class.
 */

require_once(__DIR__.'/SampleValidator.php');

class CreateValidatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Called when the validator test should construct itself.
	 */
	public function __construct()
	{
		$this->validator = new SampleValidator();

		parent::__construct();
	}

	/**
	 * This will test that this test managed to create a sample
	 * validator from reading the 'SampleValidator.php' file.
	 */
	public function testValidatorTestConstructed()
	{
		$this->assertFalse(is_null($this->validator));
	}

	/**
	 * This will test if the validator namespacing is resolved correctly.
	 * If the test fails, it is likely that the validator is conflicting
	 * with Illuminate's validator.
	 */
	public function testForValidatorNamespaceConflicts()
	{
		$parentClass = get_parent_class($this->validator);

		$this->assertEquals($parentClass, 'Softlabs\Validator\Validator');

		// If the 'Validate' method doesn't exist, we have not inherited
		// from the correct validation class.
		$this->assertTrue(method_exists($this->validator, 'Validate'));
	}

	/**
	 * This will test that our rules and messages variables were created
	 * and exist.
	 */
	public function testValidatorVariableCalls()
	{
		// We can test that variables exist on the validator.
		$this->assertTrue(is_array($this->validator->messages));
		$this->assertTrue(is_array($this->validator->rules));
	}

	/**
	 * This will test that rules and messages are replaced when constructing
	 * a validator.
	 */
	public function testReplaceRulesAndMessages()
	{
		$sampleValidator = new SampleValidator(
			['customrules'],
			['custommessages'],
			false
		);

		$this->assertEquals($sampleValidator->rules, ['customrules']);
		$this->assertEquals($sampleValidator->messages, ['custommessages']);
	}

	/**
	 * This will teste that rules and messages are merged when constructing
	 * a validator.
	 */
	public function testMergeRulesAndMessages()
	{
		$sampleValidator = new SampleValidator(
			['customrules'],
			['custommessages'],
			true
		);

		$this->assertEquals(
			$sampleValidator->rules,
			['customrules', 'field1' => 'required']
		);

		$this->assertEquals(
			$sampleValidator->messages,
			['custommessages', 'field1.required' => 'Field1 is required.']
		);
	}
}