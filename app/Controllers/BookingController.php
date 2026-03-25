<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\PaymentModel;
use App\Models\DocumentModel;
use App\Models\MeetingPointModel;
use App\Models\UserModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $paymentModel;
    protected $documentModel;
    protected $meetingPointModel;
    protected $userModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel = new TripModel();
        $this->paymentModel = new PaymentModel();
        $this->documentModel = new DocumentModel();
        $this->meetingPointModel = new MeetingPointModel();
        $this->userModel = new UserModel();
    }


    /*
    =====================================
    GENERATE BOOKING CODE
    =====================================
    */

    private function generateBookingCode()
    {
        $prefix = "TRIP";
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()),0,5));

        return $prefix.'-'.$date.'-'.$random;
    }



    /*
    =====================================
    CREATE BOOKING
    =====================================
    */

    public function create($schedule_id)
    {
        $schedule = $this->scheduleModel
            ->select('schedules.*, trips.title, trips.location, trips.price')
            ->join('trips','trips.trip_id = schedules.trip_id')
            ->where('schedule_id',$schedule_id)
            ->first();

        if(!$schedule){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $meetingPoints = $this->meetingPointModel
            ->where('trip_id',$schedule['trip_id'])
            ->findAll();

        return view('booking/create',[
            'schedule' => $schedule,
            'meetingPoints' => $meetingPoints
        ]);
    }



    /*
    =====================================
    STORE BOOKING
    =====================================
    */

    public function store()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $schedule_id = $this->request->getPost('schedule_id');
        $participant = $this->request->getPost('participant');
        $meeting_point_id = $this->request->getPost('meeting_point_id');
        $redeem_point = $this->request->getPost('redeem_point') ?? 0;
        $payment_method = $this->request->getPost('payment_method');


        /*
        ==============================
        AMBIL DATA
        ==============================
        */

        $schedule = $this->scheduleModel->find($schedule_id);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule tidak ditemukan');
        }

        $trip = $this->tripModel->find($schedule['trip_id']);

        if (!$trip) {
            return redirect()->back()->with('error', 'Trip tidak ditemukan');
        }


        /*
        ==============================
        HITUNG HARGA
        ==============================
        */

        $price = ($trip['price'] ?? 0) * ($participant ?? 1);

        $discount = ($redeem_point / 100) * 5000;

        $final_price = $price - $discount;

        if($final_price < 0){
            $final_price = 0;
        }


        /*
        ==============================
        GENERATE BOOKING CODE
        ==============================
        */

        $bookingCode = $this->generateBookingCode();


        /*
        ==============================
        INSERT BOOKING
        ==============================
        */

        $booking_id = $this->bookingModel->insert([
            'booking_code' => $bookingCode,
            'user_id' => $user_id,
            'schedule_id' => $schedule_id,
            'meeting_point_id' => $meeting_point_id,
            'participant' => $participant,
            'total_price' => $final_price,
            'status' => 'pending'
        ]);


        /*
        ==============================
        UPLOAD DOKUMEN PESERTA
        ==============================
        */

        $participants = $this->request->getPost('participants');
        $ktpFiles = $this->request->getFiles()['ktp'] ?? [];
        $healthFiles = $this->request->getFiles()['health'] ?? [];

        if(!is_dir('uploads/documents')){
            mkdir('uploads/documents',0777,true);
        }

        if($participants){
        foreach($participants as $i => $p){

            $ktpName = null;
            $healthName = null;

            if(isset($ktpFiles[$i]) && $ktpFiles[$i]->isValid()){
                $ktpName = $ktpFiles[$i]->getRandomName();
                $ktpFiles[$i]->move('uploads/documents',$ktpName);
            }

            if(isset($healthFiles[$i]) && $healthFiles[$i]->isValid()){
                $healthName = $healthFiles[$i]->getRandomName();
                $healthFiles[$i]->move('uploads/documents',$healthName);
            }

            $this->documentModel->insert([
                'booking_id' => $booking_id,
                'name' => $p['name'] ?? null,
                'email' => $p['email'] ?? null,
                'birthdate' => $p['birthdate'] ?? null,
                'gender' => $p['gender'] ?? null,
                'ktp' => $ktpName,
                'health' => $healthName
            ]);
        }
        }


        /*
        ==============================
        PAYMENT
        ==============================
        */

        $payment = $this->request->getFile('payment_proof');

        if($payment && $payment->isValid()){

            if(!is_dir('uploads/payment')){
                mkdir('uploads/payment',0777,true);
            }

            $paymentName = $payment->getRandomName();
            $payment->move('uploads/payment',$paymentName);

            $this->paymentModel->insert([
                'booking_id' => $booking_id,
                'method' => $payment_method,
                'proof' => $paymentName,
                'status' => 'pending'
            ]);
        }


        /*
        ==============================
        KURANGI KUOTA
        ==============================
        */

        $available = ($schedule['available'] ?? 0) - $participant;

        if($available < 0){
            $available = 0;
        }

        $this->scheduleModel->update($schedule_id,[
            'available' => $available
        ]);


        /*
        ==============================
        POTONG POINT
        ==============================
        */

        if($redeem_point > 0){

            $user = $this->userModel->find($user_id);

            $this->userModel->update($user_id,[
                'points' => ($user['points'] ?? 0) - $redeem_point
            ]);
        }


        return redirect()->to('/booking/detail/'.$booking_id)
            ->with('success','Booking berhasil dibuat');
    }



    /*
    =====================================
    DETAIL BOOKING
    =====================================
    */

    public function detail($booking_id)
    {
        $user_id = session()->get('user_id');

        if(!$user_id){
            return redirect()->to('/login');
        }

        $booking = $this->bookingModel
            ->where('booking_id',$booking_id)
            ->where('user_id',$user_id)
            ->first();

        if(!$booking){
            return redirect()->to('/dashboard');
        }

        $schedule = $this->scheduleModel->find($booking['schedule_id']);
        $trip = $this->tripModel->find($schedule['trip_id']);

        $payment = $this->paymentModel
            ->where('booking_id',$booking_id)
            ->first();

        $documents = $this->documentModel
            ->where('booking_id',$booking_id)
            ->findAll();

        return view('booking/detail',[
            'booking'=>$booking,
            'schedule'=>$schedule,
            'trip'=>$trip,
            'payment'=>$payment,
            'documents'=>$documents
        ]);
    }



    /*
    =====================================
    HISTORY BOOKING
    =====================================
    */

    public function history()
    {
        $user_id = session()->get('user_id');

        $bookings = $this->bookingModel
            ->select('
                bookings.*,
                trips.title as trip_title,
                schedules.departure_date
            ')
            ->join('schedules','schedules.schedule_id = bookings.schedule_id')
            ->join('trips','trips.trip_id = schedules.trip_id')
            ->where('bookings.user_id',$user_id)
            ->orderBy('booking_id','DESC')
            ->findAll();

        return view('booking/history',[
            'bookings'=>$bookings
        ]);
    }

}