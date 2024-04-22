<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::with(['customer_addresses'])->paginate(10);
        return view('customers.index')->with([
            'customers' => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:customers'],
            'phone_number' => ['required'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'customer_address.*.recipient_name' => ['required'],
            'customer_address.*.name_address' => ['required'],
            'customer_address.*.detail_address' => ['required'],
            'customer_address.*.zip_code' => ['required'],
            'customer_address.*.phone_number_address' => ['required'],
        ]);

        $photo = $request->file('photo')->store('customers', 'public');

        $create = Customer::create([
            'name' => $request->name,
            'photo' => $photo,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
        ]);

        if ($create) {
            foreach ($request->customer_address as $key => $value) {
                CustomerAddress::create([
                    'customer_id' => $create->id,
                    'recipient_name' => $value['recipient_name'],
                    'name_address' => $value['name_address'],
                    'detail_address' => $value['detail_address'],
                    'phone_number' => $value['phone_number_address'],
                    'zip_code' => $value['zip_code'],
                ]);
            }
            return redirect('/customers')->with('status', 'Customer created successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
