<?php

namespace Indigoram89\Fetchable\Test;

use Indigoram89\Fetchable\Fetchable;
use Illuminate\Database\Eloquent\Model;

class Usd extends Currency implements CurrencyInterface
{
    public function getName() : string
    {
        return 'usd';
    }

    public function getDescription() : string
    {
        return 'Dollars';
    }
}
