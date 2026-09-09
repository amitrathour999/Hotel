@extends('layouts.app')

@section('title', 'Record Payment')
@section('page_heading', 'Record Payment')

@section('content')
    <div class="card-custom" style="max-width: 760px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-credit-card text-primary"></i> Payment Record Form
            </div>
            <a href="{{ url('payment_show') }}" class="btn-secondary-custom">
                <i class="fa-solid fa-receipt"></i> View Payments Log
            </a>
        </div>

        <form action="{{ url('paymentcode') }}" method="post" autocomplete="off">
            @csrf

            <div class="form-group">
                <label class="form-label" for="bookingSelect">Select Confirmed Reservation</label>
                <select name="booking_id" id="bookingSelect" class="form-select" onchange="calculateAmount()" required>
                    <option value="" selected disabled>Choose Booking...</option>
                    @foreach($booking as $book)
                        <option value="{{ $book->id }}"
                                data-price="{{ $book->room->price ?? 0 }}"
                                data-checkin="{{ $book->check_in }}"
                                data-checkout="{{ $book->check_out }}">
                            Booking #{{ $book->id }} - Room {{ $book->room->room_number ?? '-' }} ({{ $book->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="amountInput">Total Amount (Auto Calculated ₹)</label>
                    <input type="number" step="0.01" name="amount" id="amountInput" class="form-control" placeholder="Auto Calculated" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="" selected disabled>Select Method</option>
                        <option value="cash">Cash Payment</option>
                        <option value="upi">UPI / QR Transfer</option>
                        <option value="card">Credit / Debit Card</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="status">Payment Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending">Pending</option>
                        <option value="paid" selected>Paid</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="transaction_id">Transaction / Reference ID</label>
                    <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="e.g. TXN987654321">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="paid_at">Payment Timestamp</label>
                <input type="datetime-local" name="paid_at" id="paid_at" class="form-control">
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom">
                    <i class="fa-solid fa-floppy-disk"></i> Save Payment Record
                </button>
                <a href="{{ url('payment_show') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
function calculateAmount() {
    let select = document.getElementById('bookingSelect');
    let selectedOption = select.options[select.selectedIndex];

    if (!selectedOption || !selectedOption.value) {
        document.getElementById('amountInput').value = '';
        return;
    }

    let price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
    let checkIn = selectedOption.getAttribute('data-checkin');
    let checkOut = selectedOption.getAttribute('data-checkout');

    if (price > 0 && checkIn && checkOut) {
        let date1 = new Date(checkIn);
        let date2 = new Date(checkOut);
        let timeDiff = date2.getTime() - date1.getTime();
        let days = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (days <= 0) days = 1;

        let totalAmount = days * price;
        document.getElementById('amountInput').value = totalAmount;
    } else {
        document.getElementById('amountInput').value = '';
    }
}

window.onload = function() {
    calculateAmount();
    // Set current datetime as default for paid_at
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('paid_at').value = now.toISOString().slice(0, 16);
};
</script>
@endsection