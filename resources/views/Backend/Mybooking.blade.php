@extends('layouts.app')

@section('title', 'My Booking History')
@section('page_heading', 'My Booking History')

@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="card-title-custom">
            <i class="fa-solid fa-clock-rotate-left text-primary"></i> Your Room Reservations
        </div>
        <a href="{{ url('booking') }}" class="btn-primary-custom">
            <i class="fa-solid fa-plus"></i> New Reservation
        </a>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Booking Ref</th>
                    <th>Room</th>
                    <th>Stay Dates</th>
                    <th>Guests</th>
                    <th>Total Amount</th>
                    <th>Booking Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($booking as $row)
                @php
                $checkIn = \Carbon\Carbon::parse($row->check_in);
                $checkOut = \Carbon\Carbon::parse($row->check_out);
                $nights = max(1, $checkIn->diffInDays($checkOut));
                $computedAmount = $row->payment->amount ?? ($nights * ($row->room->price ?? 0));
                $isPaid = isset($row->payment) && $row->payment->status === 'paid';
                @endphp
                <tr>
                    <td>{{ $row->id }}</td>
                    <td><strong>{{ $row->id }}</strong></td>
                    <td>
                        <div><strong>Room {{ $row->room->room_number ?? '-' }}</strong></div>
                        <small class="text-muted">{{ ucfirst($row->room->type ?? '-') }}</small>
                    </td>
                    <td>
                        <div><small class="text-muted">In:</small> {{ $row->check_in }}</div>
                        <div><small class="text-muted">Out:</small> {{ $row->check_out }} ({{ $nights }}N)</div>
                    </td>
                    <td><i class="fa-solid fa-users me-1 text-muted"></i> {{ $row->guests }}</td>
                    <td>
                        <strong style="font-size: 15px; color: #0f766e;">₹{{ number_format($computedAmount) }}</strong>
                    </td>
                    <td>
                        <span class="badge-status badge-{{ strtolower($row->status) }}">
                            {{ ucfirst($row->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-status badge-{{ $isPaid ? 'paid' : 'pending' }}">
                            <i class="fa-solid fa-{{ $isPaid ? 'circle-check' : 'clock' }} me-1"></i>
                            {{ $isPaid ? 'Paid' : 'Pending' }}
                        </span>
                        @if($isPaid && !empty($row->payment->payment_method))
                        <div><small class="text-muted" style="text-transform: uppercase;">{{ $row->payment->payment_method }}</small></div>
                        @endif
                    </td>
                    <td>
                        @if(!$isPaid && $row->status !== 'cancelled')
                        <button class="action-link action-edit" onclick="openPayModal({{ $row->id }}, '{{ $row->room->room_number ?? '' }}', {{ $computedAmount }})" style="border: none; cursor: pointer; background: #0f766e; color: #ffffff; padding: 7px 14px; border-radius: 8px;">
                            <i class="fa-solid fa-credit-card me-1"></i> Pay Now
                        </button>
                        @else
                        <span class="text-muted" style="font-size: 13px;"><i class="fa-solid fa-check-double text-success"></i> Complete</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">
                        <i class="fa-solid fa-folder-open me-2"></i> You have no active or past bookings.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($booking->hasPages())
    <div class="pagination-wrapper" style="justify-content: flex-end; padding: 16px 20px;">
        {{ $booking->links() }}
    </div>
    @endif
</div>

<!-- Pay Now Modal -->
<div id="payNowModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); z-index: 9999; align-items: center; justify-content: center; padding: 15px;">
    <div style="background: #ffffff; width: 100%; max-width: 480px; border-radius: 20px; padding: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); position: relative; animation: fadeIn 0.3s ease; max-height: 90vh; overflow-y: auto;">
        <button onclick="closePayModal()" style="position: absolute; top: 20px; right: 20px; border: none; background: #f1f5f9; border-radius: 50%; width: 32px; height: 32px; font-size: 16px; cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">
            <i class="fa-solid fa-credit-card text-primary me-2"></i> Complete Payment
        </div>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;" id="modalSubtitle">Pay for Room Reservation</p>

        <form id="payModalForm" method="POST" action="">
            @csrf

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 12px; margin-bottom: 20px; text-align: center;">
                <div style="font-size: 13px; color: #64748b;">Total Amount Due</div>
                <div style="font-size: 30px; font-weight: 800; color: #0f766e; margin-top: 2px;" id="modalAmountText">₹0</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="modal_payment_method">Select Payment Method</label>
                <select id="modal_payment_method" name="payment_method" class="form-select" required>
                    <option value="upi">UPI / GPay / PhonePe / Paytm</option>
                    <option value="card">Credit / Debit Card</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="modal_transaction_id">Transaction / UTR Ref No. (Optional)</label>
                <input type="text" id="modal_transaction_id" name="transaction_id" class="form-control" placeholder="e.g. UPI987654321">
            </div>

            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn-primary-custom" style="width: 100%; justify-content: center; padding: 12px; font-size: 15px;">
                    <i class="fa-solid fa-lock me-1"></i> Pay Now & Confirm
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openPayModal(bookingId, roomNumber, amount) {
        const modal = document.getElementById('payNowModal');
        const form = document.getElementById('payModalForm');
        const subtitle = document.getElementById('modalSubtitle');
        const amountText = document.getElementById('modalAmountText');

        form.action = "{{ url('user_pay') }}/" + bookingId;
        subtitle.innerText = `Reservation #${bookingId} - Room ${roomNumber}`;
        amountText.innerText = `₹${parseFloat(amount).toLocaleString()}`;

        modal.style.display = 'flex';
    }

    function closePayModal() {
        document.getElementById('payNowModal').style.display = 'none';
    }
</script>
@endsection