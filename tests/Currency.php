<?php

namespace Indigoram89\Fetchable\Test;

use Indigoram89\Fetchable\Fetchable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use Fetchable;

    protected $table = 'currencies';

    protected $guarded = [];

    public $timestamps = false;

    public function fetchableAttributes() : array
    {
        return [
            'name' => $this->getName(),
        ];
    }

    public function fetchableValues() : array
    {
        return [
            'description' => $this->getDescription(),
        ];
    }
}
