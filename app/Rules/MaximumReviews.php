<?php

namespace App\Rules;

use App\Models\Prospect\Prospect;
use App\Models\Prospect\Review;
use Illuminate\Contracts\Validation\Rule;

class MaximumReviews implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @param Prospect $prospect
     */
    public function __construct()
    {
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
        return Review::where('prospect_id', $value)
                     ->where('reviewable_type', 'App\Models\Mobile\MobileLead')
                     ->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have reached the maximum number of reviews of this type for this prospect.';
    }
}
