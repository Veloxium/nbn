<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show list of payments for the authenticated user
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())->get();
        return view('payments.index', compact('payments'));
    }

    // Show proof of payment form for a specific payment
    public function showProofForm(Payment $payment)
    {
        // Ensure the payment belongs to the logged-in user
        if ($payment->user_id !== Auth::id()) {
            return redirect()->route('payments.index');
        }

        return view('payments.proof', compact('payment'));
    }

    // Handle proof of payment upload
    public function uploadProof(Request $request, Payment $payment)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('proof_of_payment')) {
            $payment->proof_of_payment = $request->file('proof_of_payment')->store('proofs', 'public');
            $payment->status = 'pending'; // or completed, depending on your business logic
            $payment->save();
        }

        return redirect()->route('payments.index')->with('success', 'Proof of payment uploaded successfully!');
    }
}
