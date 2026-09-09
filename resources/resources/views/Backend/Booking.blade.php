@extends('layouts.app')

@section('title', 'Reserve Room & Payment')
@section('page_heading', 'Reserve a Hotel Room')

@section('styles')
<style>
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 768px) {
        .form-grid-2 {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endsection

@section('content')
    <div class="card-custom" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-calendar-plus text-primary"></i> New Room Reservation & Payment Form
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ url('mybooking') }}" class="btn-secondary-custom">
                    <i class="fa-solid fa-clock-rotate-left"></i> My Bookings
                </a>
            </div>
        </div>

        <form action="{{ url('bookingcode') }}" method="post" id="bookingForm">
            @csrf

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="name">Guest Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', session('user_name')) }}" placeholder="e.g. Alex Morgan" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="mobile">Mobile Number</label>
                    <input type="number" id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="e.g. 9876543210" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', session('user_email')) }}" placeholder="alex@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="guests">Number of Guests</label>
                    <input type="number" id="guests" name="guests" min="1" max="10" value="{{ old('guests', 1) }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="room_id">Select Available Room</label>
                <select id="room_id" name="room_id" class="form-select" required onchange="calculateTotal()">
                    <option value="" disabled {{ !request('room_id') ? 'selected' : '' }} data-price="0">Choose Room...</option>
                    @foreach($room as $data)
                        <option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ request('room_id') == $data->id ? 'selected' : '' }}>
                            Room {{ $data->room_number }} - {{ ucfirst($data->type) }} (₹{{ number_format($data->price) }}/night)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="check_in">Check-In Date</label>
                    <input type="date" id="check_in" name="check_in" class="form-control" min="{{ date('Y-m-d') }}" required onchange="calculateTotal()">
                </div>

                <div class="form-group">
                    <label class="form-label" for="check_out">Check-Out Date</label>
                    <input type="date" id="check_out" name="check_out" class="form-control" min="{{ date('Y-m-d') }}" required onchange="calculateTotal()">
                </div>
            </div>

            <!-- Total Price Calculation Summary Card -->
            <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; padding: 20px; border-radius: 16px; margin: 20px 0; border: 1px solid #334155;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <div style="font-size: 13px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Reservation Summary</div>
                        <div style="font-size: 16px; font-weight: 600; margin-top: 4px;" id="summaryText">Select dates and room to view price</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 12px; color: #cbd5e1;">Total Payable Amount</div>
                        <div style="font-size: 26px; font-weight: 800; color: #f59e0b;" id="totalAmountText">₹0</div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Section -->
            <div style="border-top: 1px dashed #cbd5e1; padding-top: 20px; margin-top: 10px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-credit-card text-primary"></i> Select Payment Method
                </h4>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="payment_method">Payment Mode</label>
                        <select id="payment_method" name="payment_method" class="form-select" required onchange="toggleOnlineFields()">
                            <option value="upi">UPI / GPay / PhonePe / Paytm</option>
                            <option value="card">Credit / Debit Card</option>
                            <option value="cash">Pay at Hotel (Cash on Check-In)</option>
                        </select>
                    </div>

                    <div class="form-group" id="txnGroup">
                        <label class="form-label" for="transaction_id">UPI / Reference / UTR No. (Optional)</label>
                        <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="e.g. UPI123456789">
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px;">
                <label class="form-label" for="special_requests">Special Requests (Optional)</label>
                <textarea id="special_requests" name="special_requests" class="form-control" rows="2" placeholder="Late check-in, high floor, extra pillows..."></textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom" style="padding: 12px 28px; font-size: 15px;">
                    <i class="fa-solid fa-lock"></i> Complete Booking & Payment
                </button>
                <a href="{{ url('/') }}" class="btn-secondary-custom">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function calculateTotal() {
        const roomSelect = document.getElementById('room_id');
        const selectedOption = roomSelect.options[roomSelect.selectedIndex];
        const pricePerNight = parseFloat(selectedOption ? selectedOption.getAttribute('data-price') : 0) || 0;
        
        const checkInVal = document.getElementById('check_in').value;
        const checkOutVal = document.getElementById('check_out').value;
        
        const summaryText = document.getElementById('summaryText');
        const totalAmountText = document.getElementById('totalAmountText');

        if (pricePerNight > 0 && checkInVal && checkOutVal) {
            const checkIn = new Date(checkInVal);
            const checkOut = new Date(checkOutVal);
            const timeDiff = checkOut.getTime() - checkIn.getTime();
            const nights = Math.max(1, Math.ceil(timeDiff / (1000 * 3600 * 24)));

            if (nights > 0) {
                const total = nights * pricePerNight;
                summaryText.innerText = `${nights} Night(s) Stay × ₹${pricePerNight.toLocaleString()}/night`;
                totalAmountText.innerText = `₹${total.toLocaleString()}`;
                return;
            }
        }
        
        if (pricePerNight > 0) {
            summaryText.innerText = `Room Rate: ₹${pricePerNight.toLocaleString()}/night`;
        } else {
            summaryText.innerText = 'Select room and stay dates';
        }
        totalAmountText.innerText = '₹0';
    }

    function toggleOnlineFields() {
        const method = document.getElementById('payment_method').value;
        const txnGroup = document.getElementById('txnGroup');
        if (method === 'cash') {
            txnGroup.style.display = 'none';
        } else {
            txnGroup.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        calculateTotal();
        toggleOnlineFields();
    });
</script>
@endsection