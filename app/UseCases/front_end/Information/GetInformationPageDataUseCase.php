<?php

namespace App\UseCases\front_end\Information;

use App\Repositories\HolidayDateRepository;
use App\Repositories\UserRepository;

class GetInformationPageDataUseCase {
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var HolidayDateRepository
     */
    private $holidayDateRepository;

    public function __construct(UserRepository $userRepository, HolidayDateRepository $holidayDateRepository) {
        $this->userRepository = $userRepository;
        $this->holidayDateRepository = $holidayDateRepository;
    }

    public function execute(): array {
        $data = [];
        $data['birthday_users'] = $this->userRepository->getBirthdayToday();
        $data['holiday_dates'] = $this->holidayDateRepository->get_current_month();
        return $data;
    }
}
