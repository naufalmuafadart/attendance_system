<?php

namespace App\UseCases\front_end\user\Dashboard;

use App\Repositories\UserRepository;

class GetDashboardUserDataUseCase {
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(): array
    {
        return [
            'birthday_users' => $this->userRepository->getBirthdayToday(),
        ];
    }
}
