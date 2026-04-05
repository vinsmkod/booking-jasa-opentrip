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

    /*
    =====================================
    GET BOOKING + SEMUA RELASI (1 query)
    =====================================
    */

    public function getBookingWithDetail($booking_id, $user_id)
    {
        return $this->select('
                bookings.*,
                schedules.departure_date,
                schedules.available,
                schedules.quota,
                trips.title,
                trips.location,
                trips.price,
                trips.image,
                trips.whatsapp_group,
                meeting_points.name    as meeting_point_name,
                meeting_points.address as meeting_point_address
            ')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->where('bookings.booking_id', $booking_id)
            ->where('bookings.user_id', $user_id)
            ->first();
    }

    /*
    =====================================
    METHOD LAMA (deprecated, boleh dihapus)
    =====================================
    */

    public function getBookingWithMeetingPoint($booking_id, $user_id)
    {
        return $this->getBookingWithDetail($booking_id, $user_id);
    }
}