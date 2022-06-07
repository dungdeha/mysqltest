<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Customer constructor
     */
    public function __construct() {

    }

    /**
     * Get customer
     *
     * @param $id
     * @return void
     */
    public function show($id) {
        return Customer::find($id);
    }

    /**
     * Create customer
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $customer = new Customer();

        return $customer->create($this->_getData($request));
    }

    /**
     * Update customer
     *
     * @param $id
     * @param Request $request
     * @return void
     */
    public function update($id, Request $request) {
        $customer = Customer::find($id);
        return $customer->update(['email' => 'dungdd@dehasoft.com']);
    }

    /**
     * Get request data
     *
     * @param $request
     * @return mixed
     */
    private function _getData($request) {
        return [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    /**
     * Delete customer
     *
     * @param $id
     * @return void
     */
    public function destroy($id) {
        $customer = Customer::find($id);
        return $customer->forceDelete();
    }
}
