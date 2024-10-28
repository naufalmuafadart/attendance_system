<?php

namespace App\UseCases\Users;

use App\Repositories\UserRepository;

class GetByTwoWeekShiftPatternUseCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute($shiftPatternId) {
        return $this->userRepository->getByTwoWeekShiftPatternId($shiftPatternId);
    }
}
