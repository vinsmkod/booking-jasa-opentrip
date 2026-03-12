<?php

namespace App\Libraries;

class EmailService
{
    public function sendBookingConfirmation($email, $name, $bookingCode)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);

        $emailService->setSubject('Booking Confirmation');

        $emailService->setMessage("
            Halo $name,<br>
            Booking Anda berhasil.<br>
            Kode Booking: $bookingCode
        ");

        return $emailService->send();
    }
}