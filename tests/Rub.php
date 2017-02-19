<?php

namespace Indigoram89\Fetchable\Test;

use Indigoram89\Fetchable\Fetchable;
use Illuminate\Database\Eloquent\Model;

class Rub extends Currency implements CurrencyInterface
{
    public function getName() : string
    {
        return 'rub';
    }

    public function getDescription() : string
    {
        return 'Rubles';
    }
}
