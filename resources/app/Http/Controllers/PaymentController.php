<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  public function payment()
  {
       $booking = Booking::with('room')
                          ->where('status', 'confirmed')
                          ->get();

    return view('backend.payment',compact('booking'));

  }

  public function paymentcode(Request $request)
  {
    $request->validate([
        'booking_id'=>'required',
        'amount'=>'required',
        'payment_method'=>'required|in:cash,upi,card',
        'status'=>'required|in:pending,paid,refunded', 
    ]);

    payment::create([
      'booking_id'=>$request->booking_id,
      'user_id'=>session('user_id'),
      'amount'=>$request->amount,
      'payment_method'=>$request->payment_method,
      'status'=>$request->status,
      'transaction_id'=>$request->transaction_id,
      'paid_at'=>$request->paid_at,
    ]);
    return redirect('payment_show');
  }

  public function payment_show()
  {
    $payment = payment::with(['booking.room'])->get();
    return view('backend.payment_show',compact('payment'));
  }

  public function payment_edit($id)
  {
    $data = payment::find($id);
    $booking = Booking::with('room')->get();
    return view('backend.payment_edit', compact('data', 'booking'));
  }

  public function payment_update(Request $request, $id)
  {
    $request->validate([
        'booking_id'     => 'required',
        'amount'         => 'required',
        'payment_method' => 'required|in:cash,upi,card',
        'status'         => 'required|in:pending,paid,failed,refunded',
    ]);

    $data = payment::findOrFail($id);
    $data->booking_id     = $request->booking_id;
    $data->amount         = $request->amount;
    $data->payment_method = $request->payment_method;
    $data->status         = $request->status;
    $data->transaction_id = $request->transaction_id;
    $data->paid_at        = $request->paid_at;
    $data->save();

    return redirect('payment_show')->with('success', 'Payment Updated Successfully!');
  }

  public function payment_delete($id)
  {
    $data = payment::find($id);
    if ($data) {
        $data->delete();
    }
    return redirect()->back()->with('success', 'Payment Deleted Successfully!');
  }
}
