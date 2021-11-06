<?php

namespace App\Http\Controllers;

use App\Models\Apis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ApisController extends Controller
{
    public function index()
    {
        return view('administracion.api.index');
    }
    public function getList()
    {
        return DataTables::of(Apis::get())->toJson();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Apis::create($request->all());
            DB::commit();
            return array("success" => true, "mensaje" => "Registro con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Apis::findOrFail($id)->update($request->all());
            DB::commit();
            return array("success" => true, "mensaje" => "Registro con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function destroy($id)
    {
        //after
    }
    public function apiDni($documento)
    {
        // return $documento;
        $apiDni=Apis::findOrFail(1);
        $url = $apiDni->http . $documento;
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$apiDni->token}"
            ]
        ]);
        $data = $response->getBody()->getContents();
        // Log::info($data);
        return $data;
    }
    public function apiRuc($documento)
    {
        $apiRuc=Apis::findOrFail(2);
        $url = $apiRuc->http . $documento;
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$apiRuc->token}"
            ]
        ]);
        $data = $response->getBody()->getContents();
        return $data;
    }
}
