<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 27/12/17
 * Time: 15:06
 */

namespace AeroTransfers\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as Respect;
use Slim\Http\Request;

class Validator
{
    protected $errors;

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try{
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;
        
        return $this;
    }

    public function failed() {
        return !empty($this->errors);
    }
}