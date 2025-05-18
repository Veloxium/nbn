<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\PaymentsProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{


    public function update(Request $request, $id): RedirectResponse
    {
        // Hanya admin yang boleh update
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:pending,completed,failed', // sesuaikan opsi status
            'delivery_status' => 'required|in:waiting,packaged,shipped,delivered',
            'no_resi' => 'nullable|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->delivery_status = $request->delivery_status;
        $payment->no_resi = $request->no_resi;
        if ($request->status === 'completed') {
            $payment->paid_at = Carbon::now();
        } else {
            $payment->paid_at = null; // Kosongkan jika bukan completed
        }
        $payment->save();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment status updated successfully.');
    }

    public function show(string $id): View
    {
        //get product by ID
        $payment = Payment::with('items.product')->findOrFail($id);
        // Atau berdasarkan prefix/route name
        return view('admin.proof.show', compact('payment'));
    }

    public function edit($id): View
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $payment = Payment::findOrFail($id);
        return view('admin.proof.edit', compact('payment'));
    }


    public function index(): View
    {
        if (Auth::user()->role === 'admin') {
            // Jika admin, arahkan ke payemt manage admin
            $payments = Payment::get();
            return view('admin.proof.index', compact('payments'));
        }

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
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
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

    public function cod($id): View
    {
        $payment = Payment::with('items.product')->findOrFail($id);
        return view('payments.cod', compact('payment'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
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
            'payment_method' => $request->payment_method
        ]);

        foreach ($cartItems as $item) {
            PaymentsProduct::create([
                'payment_id' => $payment->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'color' => $item->selected_color,
                'total' => $totalAmount
            ]);
        }

        Cart::where('user_id', $user)->delete();
        Product::whereIn('id', $cartItems->pluck('product_id'))->decrement('stock', $cartItems->sum('quantity'));

        // Redirect berdasarkan metode pembayaran
        if ($payment->payment_method === 'cash_on_delivery') {
            return redirect()->route('payments.cod', $payment->id);
        } else {
            return redirect()->route('payments.credit', $payment->id);
        }
    }
}
