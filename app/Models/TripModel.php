<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'trips';
    protected $primaryKey = 'trip_id';

    protected $allowedFields = [
        'title',
        'location',
        'description',
        'price',
        'image',
        'status',
        'type',
        'quota',
        'whatsapp_group',
    ];

    /**
     * Get total bookings for a specific schedule
     */
    public function getTotalBookings($schedule_id)
    {
        $db = \Config\Database::connect();
        return $db->table('bookings')
            ->where('schedule_id', $schedule_id)
            ->where('status', 'confirmed')
            ->countAllResults();
    }

    /**
     * Get all active trips with correct booking counts per schedule
     * Sorted by nearest departure date (ASC)
     */
    public function getActiveTripsWithBookings()
    {
        $db = \Config\Database::connect();

        // Subquery untuk mendapatkan schedule dengan informasi booking
        $scheduleWithBookings = $db->table('schedules')
            ->select('
                schedules.schedule_id,
                schedules.trip_id,
                schedules.departure_date,
                schedules.quota,
                schedules.available as schedule_quota,
                (SELECT COUNT(*) FROM bookings 
                 WHERE bookings.schedule_id = schedules.schedule_id 
                 AND bookings.status = "confirmed") as total_booked
            ')
            ->getCompiledSelect();

        // Subquery untuk mendapatkan schedule tercepat per trip (departure_date terkecil)
        $firstSchedule = $db->table('schedules')
            ->select('trip_id, MIN(schedule_id) as schedule_id')
            ->groupBy('trip_id')
            ->getCompiledSelect();

        // Query utama dengan perhitungan available yang benar
        // Diurutkan berdasarkan departure_date terdekat (ASC)
        return $this->select('
                trips.trip_id,
                trips.title,
                trips.type,
                trips.location,
                trips.description,
                trips.price,
                trips.status,
                trips.image,
                schedule_data.schedule_id,
                schedule_data.departure_date,
                schedule_data.quota,
                (schedule_data.quota - schedule_data.total_booked) as available
            ')
            ->join("({$scheduleWithBookings}) as schedule_data", 'schedule_data.trip_id = trips.trip_id', 'left')
            ->join("({$firstSchedule}) as first_schedule", 'first_schedule.schedule_id = schedule_data.schedule_id', 'inner')
            ->where('trips.status', 'active')
            ->orderBy('schedule_data.departure_date', 'ASC') // Urutkan berdasarkan tanggal terdekat
            ->findAll();
    }

    /**
     * Get available schedules for a specific trip
     */
    public function getTripSchedulesWithAvailability($trip_id)
    {
        $db = \Config\Database::connect();

        return $db->table('schedules')
            ->select('
                schedules.*,
                (SELECT COUNT(*) FROM bookings 
                 WHERE bookings.schedule_id = schedules.schedule_id 
                 AND bookings.status = "confirmed") as total_booked,
                (schedules.quota - (SELECT COUNT(*) FROM bookings 
                 WHERE bookings.schedule_id = schedules.schedule_id 
                 AND bookings.status = "confirmed")) as available
            ')
            ->where('schedules.trip_id', $trip_id)
            ->orderBy('schedules.departure_date', 'ASC')
            ->get()
            ->getResultArray();
    }
}
