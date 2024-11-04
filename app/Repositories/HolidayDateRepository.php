<?php

namespace App\Repositories;

interface HolidayDateRepository {
    public function get_current_month();
    public function get_current_day();
}
