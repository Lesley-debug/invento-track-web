<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')
            ->where('tenant_id', Auth::user()->tenant_id)
            ->latest()
            ->get();

        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->tenant_id !== Auth::user()->tenant_id) abort(403);
        $invoice->load(['customer', 'salesOrder.items.product', 'payments']);
        return view('invoices.show', compact('invoice'));
    }

    public function pay(Invoice $invoice, Request $request)
    {
        if ($invoice->tenant_id !== Auth::user()->tenant_id) abort(403);

        $request->validate([
            'amount'         => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'string'],
            'notes'          => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($invoice, $request) {
            Payment::create([
                'tenant_id'      => $invoice->tenant_id,
                'invoice_id'     => $invoice->id,
                'user_id'        => Auth::id(),
                'amount'         => $request->amount,
                'payment_method' => $request->payment_method,
                'notes'          => $request->notes,
                'paid_at'         => now(),
            ]);

            $totalPaid = $invoice->payments()->sum('amount');
            if ($totalPaid >= $invoice->total_amount) {
                $invoice->update(['status' => 'paid']);
            } else {
                $invoice->update(['status' => 'sent']);
            }
        });

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Payment recorded successfully!');
    }
}
