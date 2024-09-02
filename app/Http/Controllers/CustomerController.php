<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
            $filters[] = 'email';
        }

        if ($request->filled('order_number')) {
            $query->whereHas('orders', function ($q) use ($request) {
                $q->where('order_number', $request->input('order_number'));
            });
            $filters[] = 'order_number';
        }

        if ($request->filled('item_name')) {
            $query->whereHas('orders.items', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('item_name') . '%');
            });
            $filters[] = 'item_name';
        }

        $customers = $query->with('orders.items')->cursorPaginate(100);

        return view('customers.index', [
            'customers' => $customers,
            'filters' => $request->except(['page', 'cursor'])
        ]);
    }
}
