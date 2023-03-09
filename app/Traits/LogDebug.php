<?php
namespace App\Traits;

trait LogDebug
{
   
    /**
     * Print text for debug purposes
     *
     * @param string      $text       Text to print
     * @return void
     */
    public function logDebug($text,$log = false)
    {
        if($log) { 
            \Storage::disk('logs')->append('register.log','debug-> '.$text);
        }
    }

}