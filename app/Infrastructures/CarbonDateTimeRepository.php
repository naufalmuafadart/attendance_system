<?php

namespace App\Infrastructures;

use App\Repositories\DateTimeRepository;

class CarbonDateTimeRepository implements DateTimeRepository {
    public function greater_than($ts1, $ts2) {
        return $ts1->greaterThan($ts2);
    }

    public function less_than($ts1, $ts2) {
        return $ts1->lessThan($ts2);
    }

    public function get_difference_in_seconds($ts1, $ts2) {
        return $ts1->diffInSeconds($ts2);
    }
}
