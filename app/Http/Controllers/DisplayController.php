<?php

namespace App\Http\Controllers;

use App\Models\Display;
use App\Http\Requests\CrearDisplayRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    /**
    * Display a listing of the resource.
    * @param $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if(!empty($request->input())){
            $country = $request->input()["country"];
            return DB::table('displays')
            ->join('companies', 'displays.company_id', '=', 'companies.id')
            ->where('companies.country', $country)->get();
        }else{
            return Display::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearDisplayRequest $request)
    {
        if($request->hasFile('file')){
            if($_FILES["file"]["size"] > 50000000){
                return response()->json(['response' => true, 'message' => 'La imagen supera los 5 MBs'],500);
            }
            if($_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/png"){
                return response()->json(['exiresponseto' => true, 'message' => 'El archivo no es una imagen'],500);
            }
            $request->file('file')->move(public_path('/images/displays'), $_FILES["file"]["name"]); 
        }
        Display::create($request->all());
        return response()->json([
            'response' => true,
            'message' => 'Pantalla creada correctamente!'
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
        $display = Display::findOrFail($id);
        return response()->json([
            'response' => true,
            'display' => $display
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearDisplayRequest $request, $id)
    {
        $display = Display::findOrFail($id);
        $display->update($request->all());
        return response()->json([
            'response' => true,
            'message' => 'Pantalla Actualizada correctamente!'
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
        $display = Display::findOrFail($id);
        $display->delete();
        return response()->json([
            'response' => true,
            'message' => 'Pantalla Eliminada correctamente!'
        ], 200);
    }

    public function updateImage(Request $request, $id){
        if($request->hasFile('file')){
            if($_FILES["file"]["size"] > 50000000){
                return response()->json(['response' => true, 'message' => 'La imagen supera los 5 MBs'],500);
            }
            if($_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/png"){
                return response()->json(['exiresponseto' => true, 'message' => 'El archivo no es una imagen'],500);
            }
            $request->file('file')->move(public_path('/images/displays'), $_FILES["file"]["name"]); 
        }
        $display = Display::findOrFail($id);
        $display->image = $_FILES["file"]["name"];
        $display->save();
        return response()->json([
            'response' => true,
            'message' => 'Imagen Actualizada correctamente!'
        ], 200);
    }
}
