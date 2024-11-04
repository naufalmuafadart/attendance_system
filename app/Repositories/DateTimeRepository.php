<?php

namespace App\Repositories;

interface DateTimeRepository
{
    public function greater_than($ts1, $ts2);
    public function less_than($ts1, $ts2);
    public function get_difference_in_seconds($ts1, $ts2);
}
