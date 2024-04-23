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
    public function index(Request $request)
    {
        $search = $request->search;
        if ($request->has('search')) {
            $customers = Customer::with(['customer_addresses'])->where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->orWhere('phone_number', 'LIKE', '%' . $search . '%')->orWhere('gender', 'LIKE', '%' . $search . '%')->orWhere('birth_date', 'LIKE', '%' . $search . '%')->paginate(10);
        } else {
            $customers = Customer::with(['customer_addresses'])->paginate(10);
        }
        return view('customers.index', compact('customers'));
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
    public function show($id)
    {
        $customer = Customer::with(['customer_addresses'])->find($id);
        if ($customer) {
            return view('customers.detail', compact('customer'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::with(['customer_addresses'])->find($id);
        if ($customer) {
            return view('customers.edit', compact('id', 'customer'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'customer_address.*.recipient_name' => ['required'],
            'customer_address.*.name_address' => ['required'],
            'customer_address.*.detail_address' => ['required'],
            'customer_address.*.zip_code' => ['required'],
            'customer_address.*.phone_number_address' => ['required'],
        ]);

        $customer = Customer::find($id);
        if ($request->has('photo')) {
            $photo = $request->file('photo')->store('customers', 'public');
        } else {
            $photo = $customer->photo;
        }

        $create = Customer::where('id', $id)->update([
            'name' => $request->name,
            'photo' => $photo,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
        ]);

        if ($create) {
            CustomerAddress::where('customer_id', $id)->delete();
            foreach ($request->customer_address as $key => $value) {
                CustomerAddress::create([
                    'customer_id' => $id,
                    'recipient_name' => $value['recipient_name'],
                    'name_address' => $value['name_address'],
                    'detail_address' => $value['detail_address'],
                    'phone_number' => $value['phone_number_address'],
                    'zip_code' => $value['zip_code'],
                ]);
            }
            return redirect('/customers')->with('status', 'Customer updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $delete = $customer->delete();
            return redirect('/customers')->with('status', 'Customer delete successfully!');
        } else {
            abort(400);
        }
    }
}
