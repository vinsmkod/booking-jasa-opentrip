<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'booking_code',
        'user_id',
        'schedule_id',
        'participant',
        'total_price',
        'status',
        'meeting_point_id',
        'document'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method untuk mendapatkan booking dengan detail meeting point
    public function getBookingWithMeetingPoint($booking_id, $user_id)
    {
        return $this->select('bookings.*, meeting_points.name as meeting_point_name, meeting_points.address as meeting_point_address')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->where('bookings.booking_id', $booking_id)
            ->where('bookings.user_id', $user_id)
            ->first();
    }
}
