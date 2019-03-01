<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bill;
use App\Company;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation error messages to passed if error occurs
        $errorMsg = [
            'billDate.required'   => 'Bill Date is required.',
            'billFee.min'         => 'Bill Fee is required'
        ];

        // Validation object
        $request->validate([
            'billDate'  => 'required',
            'billFee'   => 'required'
        ], $errorMsg);

        // Insert query for new bill
        $billInsert = new Bill([
            'companyID'     => $request->post('companyName'),
            'billAmount'    => $request->post('billAmount'),
            'billFee'       => $request->post('billFee'),
            'billDate'      => $request->post('billDate')
        ]);

        $billInsert->save();
        return redirect('/')->with('successMsg', 'Bill Successfully Added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validation error messages to passed if error occurs
        $errorMsg = [
            'billDate.required'   => 'Bill Date is required.',
            'billAmount.required' => 'Bill Amount is required'
        ];

        // Validation object
        $request->validate([
            'billDate'  => 'required',
            'billAmount'=> 'required'
        ], $errorMsg);

        // Update query for existing bill
        $billID = $request->post('billID');
        $billEdit = Bill::find($billID);

        $billEdit->companyID    = $request->post('companyName');
        $billEdit->billDate     = $request->post('billDate');
        $billEdit->billAmount   = $request->post('billAmount');

        $billEdit->save();
        return redirect('/')->with('successMsg', 'Bill Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Delete query for existing bill
        $billID = $request->post('billID');

        DB::table('bills')->where('id', '=', $billID)->delete();
        return redirect('/')->with('successMsg', 'Bill Successfully Deleted');

    }
}
