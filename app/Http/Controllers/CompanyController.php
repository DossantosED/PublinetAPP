<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Display;
use App\Http\Requests\CrearCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearCompanyRequest $request)
    {
        Company::create($request->all());
        return response()->json([
            'response' => true,
            'message' => 'Empresa creada correctamente!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json([
            'response' => true,
            'company' => $company
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());
        return response()->json([
            'response' => true,
            'message' => 'Empresa Actualizada correctamente!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $displays = Display::where('company_id', $id)->get();
        if(count($displays) == 0){
            $company = Company::findOrFail($id);
            $company->delete();
            return response()->json([
                'response' => true,
                'message' => 'Empresa Eliminada correctamente!'
            ], 200);
        }else{
            return response()->json([
                'response' => true,
                'message' => 'Esta empresa tiene pantallas, primero eliminelas!'
            ], 500);
        }
    }

    /**
     * get all displays for a company.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function getDisplays($company_id)
    {
        $displays = Display::where('company_id', $company_id)->get();
        return response()->json([
            'response' => true,
            'displays' => $displays 
        ], 200);
    }
}
