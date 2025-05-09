<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\PaymentsProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::where('user_id', Auth::id())->get();
        return view('payments.index', compact('payments'));
    }

    public function showProofForm(Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            return redirect()->route('payments.index');
        }

        return view('payments.proof', compact('payment'));
    }

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

    public function userform(): View
    {
        return view('payments.user-form');
    }



    public function credit($id): View
    {
        $payment = Payment::with('items.product')->findOrFail($id);
        return view('payments.credit-card', compact('payment'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'postal_code' => 'required'
        ]);

        $user = Auth::id();
        $cartItems = Cart::where('user_id', $user)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $totalAmount = 0;

        foreach ($cartItems as $item) {
            $totalAmount += $item->quantity * $item->product->price;
        }

        $payment = Payment::create([
            'user_id' => $user,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'amount' => $totalAmount,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            PaymentsProduct::create([
                'payment_id' => $payment->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'color' => $item->color,
                'total' => $totalAmount
            ]);
        }

        Cart::where('user_id', $user)->delete();

        return redirect()->route('payments.credit', $payment->id);
    }
}
