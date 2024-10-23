<?php

namespace App\UseCases\Users;

use App\Repositories\UserRepository;

class GetUsersAndTheirPositionUseCase {
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute() {
        return $this->userRepository->getAllUserAndTheirPosition();
    }
}
