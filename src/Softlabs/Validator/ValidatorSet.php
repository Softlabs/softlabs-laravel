<?php namespace Softlabs\Validator;

use Illuminate\Http\Response;

class ValidatorSet
{
    /**
     * An array for storing messages from validator execution.
     * @var Array
     */
    private $messages;

    /**
     * An array for storing the validators used by this set.
     * @var Array
     */
    private $validators;

    /**
     * Called when the validator set should construct itself.
     * @param array  $data       Data to be validated.
     * @param array  $validators A collection of validators to execute on the
     * data.
     */
    public function __construct(array $validators=null)
    {
        $this->messages = [];
        $this->validators = $validators ?: [];
    }

    /**
     * Sets the validators for this set.
     * @param array $validators An array of validators to be used.
     */
    public function add(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Retrieves the validators in this set.
     * @return array An array of validators used by the set.
     */
    public function get()
    {
        return $this->validators;
    }

    /**
     * Called when the validator set should execute each of the validators.
     * @param  Closure $callback [Optional] Callback for producing a response.
     * @return boolean/response  Callback or JSON Response or True if there
     * were no validation messages.
     */
    public function execute($data, $callback=null)
    {
        if (is_null($data))
            throw new \InvalidArgumentException(
                'The data to execute on this validator set is invalid.'
            );

        foreach ($this->validators as $validator) {
            $this->messages = array_merge(
                $this->messages,
                $validator->validate($data)
            );
        }

        if ( ! empty($this->messages)) {
            if (null !== $callback) {
                return $callback($this->messages);
            }

            return \Response::json([$messages]);
        }

        // Return false if there were no failures.
        return false;
    }
}