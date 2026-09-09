@extends('layouts.app')

@section('title', 'Payment History')
@section('page_heading', 'Transactions Log')

@section('content')
    <div class="card-custom">
        <div class="card-header-custom">
            <div class="card-title-custom">
                <i class="fa-solid fa-receipt text-primary"></i> All Payments & Billing Records
            </div>
            <a href="{{ url('payment') }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i> Record Payment
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Booking Ref</th>
                        <th>Customer Details</th>
                        <th>Room</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Txn ID</th>
                        <th>Paid At</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payment as $data)
                        <tr>
                            <td>#{{ $data->id }}</td>
                            <td><strong>#{{ $data->booking_id }}</strong></td>
                            <td>
                                <strong>{{ $data->booking->name ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $data->booking->email ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge-status badge-available" style="font-size: 11px;">
                                    <i class="fa-solid fa-bed"></i> Room {{ $data->booking->room->room_number ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <strong>₹{{ number_format($data->amount, 2) }}</strong>
                            </td>
                            <td>
                                <span style="font-size: 13px; font-weight: 500; text-transform: uppercase;">
                                    @if(strtolower($data->payment_method) == 'upi')
                                        <i class="fa-solid fa-qrcode text-primary me-1"></i> UPI
                                    @elseif(strtolower($data->payment_method) == 'card')
                                        <i class="fa-solid fa-credit-card text-success me-1"></i> Card
                                    @else
                                        <i class="fa-solid fa-money-bill-wave text-warning me-1"></i> Cash
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge-status badge-{{ strtolower($data->status) }}">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                            <td>
                                <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-size: 12px; color: #475569;">
                                    {{ $data->transaction_id ?? 'N/A' }}
                                </code>
                            </td>
                            <td>
                                <small class="text-muted">{{ $data->paid_at ? \Carbon\Carbon::parse($data->paid_at)->format('d M Y, h:i A') : 'N/A' }}</small>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ url('payment_edit/'.$data->id) }}" class="action-link action-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a href="{{ url('payment_delete/'.$data->id) }}" class="action-link action-delete" onclick="return confirm('Are you sure you want to delete this payment record?')">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-receipt me-2"></i> No payment logs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payment->hasPages())
            <div class="pagination-wrapper" style="justify-content: flex-end; padding: 16px 20px;">
                {{ $payment->links() }}
            </div>
        @endif
    </div>
@endsection