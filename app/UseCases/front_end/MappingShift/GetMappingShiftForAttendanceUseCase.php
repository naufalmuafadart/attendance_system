<?php

namespace App\UseCases\front_end\MappingShift;

use App\Exceptions\NotFoundException;
use App\Repositories\MappingShiftRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\UserRepository;

class GetMappingShiftForAttendanceUseCase {
    /**
     * @var MappingShiftRepository
     */
    private $mappingShiftRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ShiftRepository
     */
    private $shiftRepository;

    public function __construct(
        MappingShiftRepository $mappingShiftRepository,
        UserRepository $userRepository,
        ShiftRepository $shiftRepository) {
        $this->mappingShiftRepository = $mappingShiftRepository;
        $this->userRepository = $userRepository;
        $this->shiftRepository = $shiftRepository;
    }

    public function execute($user_id) {
        try {
            $user = $this->userRepository->getById($user_id); // get user

            // if user not security
            if ($user->is_security == 0) {
                return $this->mappingShiftRepository->get_by_user_id_and_date($user_id, date('Y-m-d'));
            }

            // get previous day shift
            try {
                $mapping_shift = $this->mappingShiftRepository->get_by_user_id_and_date($user_id, date('Y-m-d',strtotime("-1 days")));
            } catch (NotFoundException $e) {
                return $this->mappingShiftRepository->get_by_user_id_and_date($user_id, date('Y-m-d'));
            }
            $shift_id = $mapping_shift->shift_id;
            $shift = $this->shiftRepository->get_by_id($shift_id);

            $check_in_time = strtotime($shift->jam_masuk);
            $check_out_time = strtotime($shift->jam_keluar);

            $today = date('Y-m-d');

            if ($check_in_time > $check_out_time && $mapping_shift->jam_absen != null && $mapping_shift->jam_pulang == null) {
                return $this->mappingShiftRepository->get_by_user_id_and_date($user_id, date('Y-m-d',strtotime("-1 days")));
            }
            return $this->mappingShiftRepository->get_by_user_id_and_date($user_id, $today);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
