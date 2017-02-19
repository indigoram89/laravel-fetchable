<?php

namespace Indigoram89\Fetchable\Test;

class FetchableTest extends TestCase
{
    /** @test */
    public function fetch_one()
    {
        $currency = (new Rub)->fetch();

        $this->assertInstanceOf(CurrencyInterface::class, $currency);

        $this->assertEquals('rub', $currency->name);

        $this->assertEquals('Rubles', $currency->description);
    }

    /** @test */
    public function fetch_many()
    {
        (new Rub)->fetch();
        (new Usd)->fetch();

        $currencies = Currency::get();

        $this->assertInstanceOf(Rub::class, $currencies->first());
        $this->assertInstanceOf(Usd::class, $currencies->last());

        $currency = Currency::first();

        $this->assertInstanceOf(Rub::class, $currency);
    }
}
