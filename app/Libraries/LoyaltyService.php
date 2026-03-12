<?php

namespace App\Libraries;

use App\Models\UserModel;

class LoyaltyService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function addPoints($userId, $transactionAmount)
    {
        $pointsEarned = floor($transactionAmount / 10000);

        $user = $this->userModel->find($userId);

        if (!$user) return false;

        $totalPoints = $user['points'] + $pointsEarned;

        $level = $this->calculateLevel($totalPoints);

        return $this->userModel->update($userId, [
            'points' => $totalPoints,
            'level' => $level
        ]);
    }

    private function calculateLevel($points)
    {
        if ($points >= 1000) return 'Gold';
        if ($points >= 500) return 'Silver';
        return 'Bronze';
    }
}