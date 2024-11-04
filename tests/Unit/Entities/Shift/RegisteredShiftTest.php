<?php

namespace Tests\Unit\Entities\Shift;

use App\Entities\Shift\RegisteredShift;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class RegisteredShiftTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_can_retrieve_argument_correctly()
    {
        $now = Carbon::now();
        $entity = new RegisteredShift(
            1,
            'John',
            '7:12',
            '17:00',
            $now,
            $now
        );

        $dt_clock_in = Carbon::parse('07:12');
        $dt_clock_out = Carbon::parse('17:00');

        $this->assertEquals(1, $entity->id);
        $this->assertEquals('John', $entity->name);
        $this->assertEquals($dt_clock_in, $entity->clock_in);
        $this->assertEquals($dt_clock_out, $entity->clock_out);
        $this->assertEquals($now, $entity->created_at);
        $this->assertEquals($now, $entity->updated_at);
    }
}
