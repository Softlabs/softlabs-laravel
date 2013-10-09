<?php

use Mockery as m;
use Softlabs\Validator\Validator;
use Softlabs\Validator\ValidatorSet;

/**
 * This test case will attempt to create a validator set
 * containing multiple validators and attempt to execute
 * them to see results.
 */

require_once(__DIR__.'/SampleValidator.php');

class CreateValidatorSetTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Close mockery.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		m::close();
	}

	/**
	 * This will test that we are able to construct a
	 * validator set.
	 */
	public function testValidatorSetConstructor()
	{
		$validatorSet = new ValidatorSet();

		$this->assertNotNull($validatorSet);
	}

	/**
	 * This will test that the 'setValidators' method on ValidatorSet
	 * executes successfully.
	 */
	public function testSetValidators()
	{
		$sampleValidator = new SampleValidator();
		$validatorSet = new ValidatorSet();

		$this->assertTrue(method_exists($validatorSet, 'setValidators'));
		$this->assertTrue(method_exists($validatorSet, 'getValidators'));

		$validatorSet->setValidators([$sampleValidator]);

		$this->assertEquals($validatorSet->getValidators()[0], $sampleValidator);
	}

	/**
	 * This will test that when providing an invalid argument
	 * as data to validate, an exception is thrown.
	 */
	public function testValidatorInvalidArgument()
	{
		try {
			$sampleValidator = new SampleValidator();

			$validatorSet = new ValidatorSet();
			$validatorSet->setValidators([$sampleValidator]);

			$value = $validatorSet->execute(null);
		}
		catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail("An 'InvalidArgumentException' has not been raised.");
	}

	public function testValidationWithNoInput()
	{
		$sampleValidator = new SampleValidator();
		$result = $sampleValidator->validate(null);
	}

	/**
	 * This will test that breaking validation rules
	 * provides messages in a validator set.
	 * @return [type] [description]
	 */
	public function testValidatorReturnsMessages()
	{
		// $sampleValidator = new SampleValidator(null, null, false, $validatorFactory);

		// $validatorSet = new ValidatorSet();
		// $validatorSet->setValidators([$sampleValidator]);

		// $value = $validatorSet->execute(['field1' => ''], $validatorFactory);

		// $this->assertNull($value);
	}
}