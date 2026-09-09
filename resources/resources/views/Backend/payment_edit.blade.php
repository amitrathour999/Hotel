@extends('layouts.app')

@section('title', 'Edit Payment')
@section('page_heading', 'Modify Payment Record')

@section('content')
    <div class="card-custom" style="max-width: 760px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-pen-to-square text-primary"></i> Edit Payment Record #{{ $data->id }}
            </div>
            <a href="{{ url('payment_show') }}" class="btn-secondary-custom">
                <i class="fa-solid fa-arrow-left"></i> Back to Payments
            </a>
        </div>

        <form action="{{ url('payment_update/'.$data->id) }}" method="post">
            @csrf

            <div class="form-group">
                <label class="form-label" for="booking_id">Associated Reservation</label>
                <select name="booking_id" id="booking_id" class="form-select" required>
                    <option value="">Select Booking</option>
                    @foreach($booking as $book)
                        <option value="{{ $book->id }}" {{ $data->booking_id == $book->id ? 'selected' : '' }}>
                            Booking #{{ $book->id }} - Room {{ $book->room->room_number ?? '-' }} - {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="amount">Payment Amount (₹)</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ $data->amount }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="cash" {{ $data->payment_method == 'cash' ? 'selected' : '' }}>Cash Payment</option>
                        <option value="upi" {{ $data->payment_method == 'upi' ? 'selected' : '' }}>UPI Transfer</option>
                        <option value="card" {{ $data->payment_method == 'card' ? 'selected' : '' }}>Credit / Debit Card</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="status">Payment Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $data->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $data->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $data->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="transaction_id">Transaction ID</label>
                    <input type="text" name="transaction_id" id="transaction_id" class="form-control" value="{{ $data->transaction_id }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="paid_at">Paid Timestamp</label>
                <input type="datetime-local" name="paid_at" id="paid_at" class="form-control" value="{{ $data->paid_at ? \Carbon\Carbon::parse($data->paid_at)->format('Y-m-d\TH:i') : '' }}">
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom">
                    <i class="fa-solid fa-floppy-disk"></i> Update Payment Record
                </button>
                <a href="{{ url('payment_show') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>
    </div>
@endsection
