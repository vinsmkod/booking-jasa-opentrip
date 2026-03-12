<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\LoyaltyModel;

class CRMService
{
    public function addPoint($user_id, $booking_id, $total)
    {
        $point = floor($total / 10000); // contoh 10rb = 1 point

        $loyaltyModel = new LoyaltyModel();

        $loyaltyModel->save([
            'user_id' => $user_id,
            'booking_id' => $booking_id,
            'point' => $point,
            'deskripsi' => 'Point dari transaksi'
        ]);

        $userModel = new UserModel();

        $user = $userModel->find($user_id);

        $newPoint = $user['point'] + $point;

        $level = 'bronze';

        if ($newPoint >= 1000)
            $level = 'platinum';
        elseif ($newPoint >= 500)
            $level = 'gold';
        elseif ($newPoint >= 200)
            $level = 'silver';

        $userModel->update($user_id, [
            'point' => $newPoint,
            'level' => $level
        ]);
    }
}