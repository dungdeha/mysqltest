<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

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
     * @return json
     */
    public function store(Request $request) {
        DB::beginTransaction();
        try {
            DB::select('call customer_insert(?, ?, ?, ?)', $this->_getData($request));
            DB::commit();

            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail($e->getMessage());
        }
    }

    /**
     * Update customer
     *
     * @param $id
     * @param Request $request
     * @return json
     */
    public function update($id, Request $request) {
        DB::beginTransaction();
        try {
            DB::select('call customer_update(?, ?, ?, ?, ?)', $this->_getUpdateData($id, $request));
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get request data
     *
     * @param $request
     * @return mixed
     */
    private function _getData($request) {
        return [
            $request->fullname,
            $request->email,
            $request->phone,
            $request->address
        ];
    }

    /**
     * @param $id
     * @param $request
     * @return void
     */
    private function _getUpdateData($id, $request) {
        return [
            $id,
            $request->fullname,
            $request->email,
            $request->phone,
            $request->address
        ];
    }

    /**
     * Delete customer
     *
     * @param $id
     * @return json
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {
            DB::select('call customer_delete(?)', [$id]);
            DB::commit();
            return $this->success();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Response success
     *
     * @param $data
     * @return JsonResponse
     */
    public function success($data = null)
    {
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    /**
     * Response fail
     *
     * @param $message
     * @return JsonResponse
     */
    public function fail($message)
    {
        return response()->json([
            'status' => false,
            'message' => [$message],
        ]);
    }

}
