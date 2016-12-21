<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('dashboard.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company([
            'name' => $request->name,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'fax' => $request->fax,
            'tax_administration' => $request->administration,
            'tax_number' => $request->taxNumber,
            'mersis_number' => $request->mersis,
            'vat' => $request->vat,
            'address' => $request->address,
            'bank_name' => $request->bankName,
            'bank_branch' => $request->bankBranch,
            'branch_number' => $request->branch_number,
            'account_number' => $request->accountNumber,
            'swift' => $request->swiftCode,
            'iban' => $request->iban,
            'branch_address' => $request->branchAddress
        ]);

        $company->save();

        $imageName = $company->id . '.' . $request->file('companyLogo')->getClientOriginalExtension();

        $request->file('companyLogo')->move(
            base_path() . '/public/images', $imageName
        );

        $company->logo_path = $imageName;
        $company->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
