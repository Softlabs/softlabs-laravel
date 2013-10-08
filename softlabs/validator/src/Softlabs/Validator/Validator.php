<?php namespace Softlabs\Validator;

abstract class Validator
{
    /**
     * An array containing all of the rules associated to this validator.
     * @var array
     */
    protected $rules;

    /**
     * An array containing all of the messages to display for each broken
     * rule in the validator.
     * @var array
     */
    protected $messages;

    /**
     * Called when the validator should construct itself. The validator
     * @param array $rules An alternative set of rules for the
     * validator to use.
     * @param array $messages An alternative set of messages for the
     * validator to use.
     * @param  boolean $merge Merges specified rules and messages with
     * the originals instead of replacing them.
     */
    public function __construct($rules=null, $messages=null, $merge=false)
    {
        if ( ! is_null($rules)) {
            $this->rules = $merge
                ? array_merge($this->rules, $rules)
                : $this->replaceRules($rules);
        } else {
            $this->rules = [];
        }

        if ( ! is_null($messages)) {
            $this->messages = $merge
                ? array_merge($this->messages, $messages)
                : $this->replaceMessages($messages);
        } else {
            $this->messages = [];
        }
    }

    /**
     * Replaces the current rules holded by the validator.
     * @return array An array of validation rules.
     */
    public function replaceRules($rules)
    {
        if (is_null($rules) or ! is_array($rules)) {
            throw new \InvalidArgumentException(
                'The rules specified for this validator are invalid.'
            );

            return;
        }

        $this->rules = $rules;
    }

    /**
     * Replaces the current messages holded by the validator.
     * @return array An array of validation messages.
     */
    public function replaceMessages($messages)
    {
        if (is_null($messages) or ! is_array($messages)) {
            throw new \InvalidArgumentException(
                'The messages specified for this validator are invalid.'
            );

            return;
        }

        $this->messages = $messages;
    }

    /**
     * Called when the validator should execute.
     * @param  array $input Any input data to be validated by this
     * validator.
     * @return array        The results of the validation process.
     */
    public function validate($input=null)
    {
        // Retrieve input if no input was specified.
        $input = $input ?: \Input::all();

        $result = \Validator::make($input, $this->rules, $this->messages);

        if ($result->fails()) {
            return $result->messages()->toArray();
        }

        // Return an empty array if the validator did not fail.
        return [];
    }
}