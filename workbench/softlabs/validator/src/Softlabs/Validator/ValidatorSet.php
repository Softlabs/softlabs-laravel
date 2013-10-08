<?php namespace Softlabs\Validator;

class ValidatorSet
{
    /**
     * An array for storing messages from validator execution.
     * @var Array
     */
    private $messages;

    /**
     * Called when the validator set should construct itself.
     * @param array  $data       Data to be validated.
     * @param array  $validators A collection of validators to execute on the
     * data.
     */
    public function __construct($data, array $validators)
    {
        $this->messages = [];

        foreach ($validators as $validator) {
            $messages = array_merge($messages, $validator->validate($data));
        }
    }

    /**
     * Called when the validator set should execute each of the validators.
     * @param  Closure $callback [Optional] Callback for producing a response.
     * @return boolean/response  Callback or JSON Response or True if there
     * were no validation messages.
     */
    public function execute($callback=null)
    {
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