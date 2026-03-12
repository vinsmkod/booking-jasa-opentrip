<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use Dompdf\Dompdf;

class InvoiceController extends BaseController
{
    protected $bookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function generate($bookingId)
    {
        $booking = $this->bookingModel
            ->select('
                bookings.*,
                users.name,
                trips.title,
                schedules.departure_date
            ')
            ->join('users','users.user_id = bookings.user_id')
            ->join('schedules','schedules.schedule_id = bookings.schedule_id')
            ->join('trips','trips.trip_id = schedules.trip_id')
            ->where('bookings.booking_id',$bookingId)
            ->first();

        if(!$booking){
            return redirect()->back()->with('error','Booking tidak ditemukan');
        }

        $html = view('invoice/template',[
            'booking'=>$booking
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $dompdf->stream(
            "Invoice-".$booking['booking_code'].".pdf",
            ["Attachment"=>false]
        );
    }
}