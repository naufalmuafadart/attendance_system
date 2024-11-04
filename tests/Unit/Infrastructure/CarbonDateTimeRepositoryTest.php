<?php

namespace Tests\Unit\Infrastructure;

use App\Infrastructures\CarbonDateTimeRepository;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class CarbonDateTimeRepositoryTest extends TestCase
{
    public function testCreate() {
        $repository = new CarbonDateTimeRepository();
        $this->assertInstanceOf(CarbonDateTimeRepository::class, $repository);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_greater_than()
    {
        $repository = new CarbonDateTimeRepository();
        $ts1 = Carbon::createFromFormat('H:i', '07:15');
        $ts2 = Carbon::createFromFormat('H:i', '08:15');
        $this->assertTrue($repository->greater_than($ts2, $ts1));

        $ts1 = Carbon::createFromFormat('H:i', '08:15');
        $this->assertFalse($repository->greater_than($ts2, $ts1));
    }

    public function test_less_than()
    {
        $repository = new CarbonDateTimeRepository();
        $ts1 = Carbon::createFromFormat('H:i', '07:15');
        $ts2 = Carbon::createFromFormat('H:i', '08:15');

        $ts1 = Carbon::createFromFormat('H:i', '08:15');
        $this->assertFalse($repository->less_than($ts1, $ts2));
    }

    public function test_get_difference_in_second() {
        $repository = new CarbonDateTimeRepository();
        $ts1 = Carbon::createFromFormat('H:i', '07:15');
        $ts2 = Carbon::createFromFormat('H:i', '08:15');
        $this->assertEquals(60*60, $repository->get_difference_in_seconds($ts1, $ts2));
        $this->assertEquals(60*60, $repository->get_difference_in_seconds($ts2, $ts1));
    }
}
