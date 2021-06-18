<?php

namespace App\Exceptions;

use Exception;

class PostNotBelongsToUser extends Exception
{
    public function render($a)
    {
        return ['errors'=> 'You aren\'t allow to '. $a.' this post'];
    }
}
