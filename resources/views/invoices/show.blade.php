@extends('layouts.app')
@section('title', 'Invoice')
@section('page-title', 'Invoice')
@section('page-subtitle', 'View invoice and record payments')
@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="max-w-3xl mx-auto space-y-6">

    {{-- Invoice Header --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="font-bold text-gray-900 text-xl font-mono">{{ $invoice->invoice_number }}</h2>
                <p class="text-gray-500 text-sm mt-1">Customer: <span class="font-medium text-gray-700">{{ $invoice->customer->name ?? '—' }}</span></p>
                <p class="text-gray-500 text-sm">Due: <span class="font-medium text-gray-700">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') : '—' }}</span></p>
            </div>
            <div class="text-right">
                @if($invoice->status === 'paid')
                    <span class="bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-2 rounded-full">✓ Paid</span>
                @elseif($invoice->status === 'sent')
                    <span class="bg-blue-50 text-blue-700 text-sm font-medium px-4 py-2 rounded-full">Partial</span>
                @elseif($invoice->status === 'overdue')
                    <span class="bg-red-50 text-red-700 text-sm font-medium px-4 py-2 rounded-full">Overdue</span>
                @else
                    <span class="bg-amber-50 text-amber-700 text-sm font-medium px-4 py-2 rounded-full">Unpaid</span>
                @endif
                <p class="text-2xl font-bold text-gray-900 mt-3">${{ number_format($invoice->total_amount, 2) }}</p>
                @php $totalPaid = $invoice->payments->sum('amount'); @endphp
                @if($totalPaid > 0)
                    <p class="text-sm text-emerald-600 font-medium">Paid: ${{ number_format($totalPaid, 2) }}</p>
                    <p class="text-sm text-red-600 font-medium">Balance: ${{ number_format($invoice->total_amount - $totalPaid, 2) }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Invoice Items --}}
    @if($invoice->salesOrder)
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Items</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($invoice->salesOrder->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $item->product->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 text-gray-700">${{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">${{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 border-t border-gray-200">
                    <tr>
                        <td colspan="3" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total</td>
                        <td class="px-6 py-3 font-bold text-gray-900">${{ number_format($invoice->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

    {{-- Payment History --}}
    @if($invoice->payments->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Payment History</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($invoice->payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d M Y, H:i') : $payment->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-gray-700 capitalize">{{ $payment->payment_method }}</td>
                        <td class="px-6 py-4 font-semibold text-emerald-700">${{ number_format($payment->amount, 2) }}</td>
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $payment->notes ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Record Payment --}}
    @if($invoice->status !== 'paid' && $invoice->status !== 'cancelled')
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">
            <h3 class="font-semibold text-indigo-900 mb-2">Record Payment</h3>
            <form action="{{ route('invoices.pay', $invoice) }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-indigo-800 mb-1">Amount *</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                            <input type="number" name="amount" step="0.01" min="0.01"
                                value="{{ number_format($invoice->total_amount - $invoice->payments->sum('amount'), 2) }}"
                                class="w-full border border-indigo-200 rounded-xl pl-8 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-indigo-800 mb-1">Payment Method *</label>
                        <select name="payment_method" class="w-full border border-indigo-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                            <option value="cash">Cash</option>
                            <option value="mobile_money">Mobile Money</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cheque">Cheque</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-indigo-800 mb-1">Notes</label>
                    <input type="text" name="notes" placeholder="Optional payment notes..."
                        class="w-full border border-indigo-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-indigo-500/25">
                        Record Payment
                    </button>
                </div>
            </form>
        </div>
    @endif

    <a href="{{ route('invoices.index') }}" class="inline-block text-sm text-gray-500 hover:text-gray-700">← Back to Invoices</a>
</div>
@endsection
