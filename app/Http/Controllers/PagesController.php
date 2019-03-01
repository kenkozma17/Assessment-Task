<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Bill;

class PagesController extends Controller
{
    // Redirects to index view
    public function index() {

        // Fetches all companies from DB and sends to index view
        $companies = Company::all();

        // Fetches all bills from DB and sends to index view
        $bills = Bill::all();
        $companyBills = DB::table('companies')->join('bills', 'bills.companyID', '=', 'companies.id')->get();

        return view('pages.index', compact('companies', 'bills', 'companyBills'));
    }

}
