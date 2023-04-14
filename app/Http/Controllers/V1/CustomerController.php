<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $customers = Customer::where($filterItems);

        if ($request->query('nested')) {
            $customers->with('invoices');
        }

        $customers = $customers
            ->paginate()
            ->appends($request->query());

        return new CustomerCollection($customers);
    }

    public function store(StoreCustomerRequest $request): CustomerResource
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): CustomerResource
    {
        if (request()->query('nested')) {
            $customer->load('invoices');
        }

        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
