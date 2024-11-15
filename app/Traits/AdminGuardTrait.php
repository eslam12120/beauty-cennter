<?php

namespace App\Traits;



Trait AdminGuardTrait
{

        function getGuard ()
    {
        return auth()->guard('admin');
    }

}

