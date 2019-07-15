<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Movie;

class DateAndTitleUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes. 
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($movie = Movie::where('title', $value)->first()){

            if(Movie::where('releaseDate',  $movie->releaseDate)->first()){
                return false;
            }
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
        return 'The Date and Title are not unique';
    }
}
