<?php

namespace App\UseCases\Users;

use App\Repositories\UserRepository;

class GetByShiftPatternUseCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute($shiftPatternId) {
        return $this->userRepository->getByShiftPatternId($shiftPatternId);
    }
}
