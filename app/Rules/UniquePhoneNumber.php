<?php

namespace App\Rules;

use App\Models\Prospect\Contact;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;

class UniquePhoneNumber implements Rule
{
    public $ignore;

    /**
     * Create a new rule instance.
     *
     * @param null $ignore
     */
    public function __construct($ignore = null)
    {
        $this->ignore = $ignore;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $phoneNumber = PhoneNumber::make(
                $value,
                'GB'
            )->formatNational();

            $query = Contact::where(function ($qry) use ($phoneNumber) {
                $qry->where('landline_phone_number', $phoneNumber)
                    ->orWhere('mobile_phone_number', $phoneNumber);
            });

            $this->ignore && $query->where('id', '<>', $this->ignore);

            return $query->count() > 0
                ? false
                : true;
        } catch (Exception $e) {
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is a duplicate phone number.';
    }
}
