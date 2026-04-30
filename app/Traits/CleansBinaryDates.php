<?php

namespace App\Traits;

use Carbon\Carbon;

trait CleansBinaryDates
{
    /**
     * Override asDateTime to clean binary data from hosting.
     *
     * @param  mixed  $value
     * @return \Illuminate\Support\Carbon
     */
    protected function asDateTime($value)
    {
        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        if (is_string($value)) {
            // Remove binary null bytes and non-printable control characters
            $value = preg_replace('/[[:cntrl:]]/', '', $value);
            
            // Fallback if string is empty or corrupted after cleaning (doesn't start with a number)
            if (empty($value) || !preg_match('/^[0-9]/', $value)) {
                return parent::asDateTime(now());
            }
        }

        return parent::asDateTime($value);
    }
}
