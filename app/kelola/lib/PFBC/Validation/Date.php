<?php
class Validation_Date extends Validation {
    protected $message = "Error: %element% must contain a valid date.";

    public function isValid($value) {
		list($dd,$mm,$yy)=explode("/",$value);
		$value="$mm/$dd/$yy";
        try {
            $date = new DateTime($value);
            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
