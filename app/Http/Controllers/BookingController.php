<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function booking()
    {
        $room = Room::where('status', 'available')->get();
        return view('backend.booking', compact('room'));
    }

    public function bookingcode(Request $request)
    {
        // Validation
        $request->validate([
            'room_id'        => 'required|exists:rooms,id',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after:check_in',
            'payment_method' => 'required|in:cash,upi,card',
        ]);

        // Double Booking Check
        $alreadyBooked = Booking::where('room_id', $request->room_id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);
            })
            ->exists();

        // Agar room already booked hai
        if ($alreadyBooked) {
            return back()
                ->withInput()
                ->with('error', 'This room is already booked for these dates.');
        }

        // Room details & calculate total amount
        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = max(1, $checkIn->diffInDays($checkOut));
        $totalAmount = $nights * $room->price;

        $isOnlinePayment = in_array($request->payment_method, ['upi', 'card']);
        $bookingStatus = 'pending'; // Requires Admin Confirmation
        $paymentStatus = $isOnlinePayment ? 'paid' : 'pending';
        $txnId = $isOnlinePayment ? ($request->transaction_id ?: 'TXN' . strtoupper(uniqid())) : null;

        // Booking Create
        $booking = Booking::create([
            'room_id'          => $request->room_id,
            'user_id'          => session('user_id'),
            'name'             => $request->name,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'guests'           => $request->guests,
            'check_in'         => $request->check_in,
            'check_out'        => $request->check_out,
            'special_requests' => $request->special_requests,
            'status'           => $bookingStatus,
        ]);

        // Payment Create
        Payment::create([
            'booking_id'     => $booking->id,
            'user_id'        => session('user_id'),
            'amount'         => $totalAmount,
            'payment_method' => $request->payment_method,
            'status'         => $paymentStatus,
            'transaction_id' => $txnId,
            'paid_at'        => $isOnlinePayment ? now() : null,
        ]);

        $msg = 'Reservation Submitted Successfully! Your booking status is currently Pending until Admin confirmation.';

        return redirect('mybooking')->with('success', $msg);
    }

    public function Booking_show(Request $request)
    {
        $booking = Booking::with(['room', 'payment'])->latest()->paginate(5);
        return view('backend.booking_show', compact('booking'));
    }

    public function Booking_edit(Request $request, $id)
    {
        $data = Booking::find($id);

        $room = Room::where('status', 'available')
            ->orWhere('id', $data->room_id)
            ->get();

        return view('backend.booking_edit', compact('data', 'room'));
    }

    public function booking_update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'room_id'   => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Current booking
        $booking = Booking::findOrFail($id);

        // Double Booking Check
        $alreadyBooked = Booking::where('room_id', $request->room_id)
            ->where('id', '!=', $id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);
            })
            ->exists();

        // Agar room already booked hai
        if ($alreadyBooked) {
            return back()
                ->withInput()
                ->with('error', 'This room is already booked for these dates.');
        }

        // Update
        $booking->room_id = $request->room_id;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        return redirect('booking_show')
            ->with('success', 'Booking Updated Successfully!');
    }

    public function booking_status(Request $request, $id)
    {
        $data = Booking::find($id);
        $data->status = $request->status;
        $data->save();

        if ($request->status == 'confirmed') {
            session()->flash('msg', 'Booking Confirmed Successfully!');
            session()->flash('type', 'success');
        } elseif ($request->status == 'cancelled') {
            session()->flash('msg', 'Booking Cancelled!');
            session()->flash('type', 'danger');
        } else {
            session()->flash('msg', 'Booking Status Completed!');
            session()->flash('type', 'info');
        }

        return redirect('booking_show');
    }

    public function booking_delete($id)
    {
        $data = Booking::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->back();
    }

    public function mybooking()
    {
        $user_id = session('user_id');
        $booking = Booking::with(['room', 'payment'])->where('user_id', $user_id)->latest()->paginate(5);
        return view('backend.mybooking', compact('booking'));  
    }

    public function userPayNow(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:upi,card,cash',
        ]);

        $booking = Booking::with('room')->where('id', $id)->where('user_id', session('user_id'))->firstOrFail();

        $checkIn = Carbon::parse($booking->check_in);
        $checkOut = Carbon::parse($booking->check_out);
        $nights = max(1, $checkIn->diffInDays($checkOut));
        $totalAmount = $nights * ($booking->room->price ?? 0);

        $isOnlinePayment = in_array($request->payment_method, ['upi', 'card']);
        $paymentStatus = $isOnlinePayment ? 'paid' : 'pending';
        $txnId = $isOnlinePayment ? ($request->transaction_id ?: 'TXN' . strtoupper(uniqid())) : null;

        Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'user_id'        => session('user_id'),
                'amount'         => $totalAmount,
                'payment_method' => $request->payment_method,
                'status'         => $paymentStatus,
                'transaction_id' => $txnId,
                'paid_at'        => $isOnlinePayment ? now() : null,
            ]
        );

        if ($isOnlinePayment) {
            $booking->status = 'confirmed';
            $booking->save();
        }

        return redirect('mybooking')->with('success', 'Payment processed successfully! Your reservation is confirmed.');
    }
}
