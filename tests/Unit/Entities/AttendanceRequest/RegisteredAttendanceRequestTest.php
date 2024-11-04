<?php

namespace Tests\Unit\Entities\AttendaceRequest;

use App\Entities\AttendanceRequest\RegisteredAttendanceRequestEntity;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class RegisteredAttendanceRequestTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_can_retrieve_argument_correctly() {
        $now = Carbon::now();
        $entity = new RegisteredAttendanceRequestEntity(
            1,
            2,
            3,
            '07:15:01',
            '16:15:02',
            'reason',
            '/file',
            'pending',
            4,
            'reject reason',
            $now,
            $now,
        );

        $dt_clock_in = Carbon::createFromFormat('H:i:s', '07:15:01');
        $dt_clock_out = Carbon::createFromFormat('H:i:s', '16:15:02');

        $this->assertEquals(1, $entity->id);
        $this->assertEquals(2, $entity->user_id);
        $this->assertEquals(3, $entity->mapping_shift_id);
        $this->assertTrue($entity->clock_in->equalTo($dt_clock_in));
        $this->assertTrue($entity->clock_out->equalTo($dt_clock_out));
        $this->assertEquals('reason', $entity->reason);
        $this->assertEquals('/file', $entity->file);
        $this->assertEquals('pending', $entity->status);
        $this->assertEquals(4, $entity->approved_by);
        $this->assertEquals('reject reason', $entity->reject_reason);
        $this->assertEquals($now, $entity->created_at);
        $this->assertEquals($now, $entity->updated_at);
    }
}
