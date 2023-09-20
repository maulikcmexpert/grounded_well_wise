<?php

namespace App\Rules;

use App\Models\User; // Adjust the namespace based on your User model location
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmail implements ValidationRule
{
    public function passes($attribute, $value)
    {
        return User::where('email', $value)->doesntExist();
    }
}
