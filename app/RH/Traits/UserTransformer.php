<?php namespace App\RH\Traits;


use App\User;
use Illuminate\Support\Collection;

trait UserTransformer
{
    private static function initializeMacro() {

        Collection::macro('userTransformer', function() {

            $charCount = strlen(User::employeeIdHighestCharCount());

            return collect($this->items)->map(function($user) use($charCount) {
                $user->employee_id = sprintf("%0{$charCount}d", $user->employee_id);
                return $user;
            });
        });
    }
}