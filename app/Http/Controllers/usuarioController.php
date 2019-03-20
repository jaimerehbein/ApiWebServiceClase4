<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MySQLUtil;

class usuarioController extends Controller
{
    public function index()
    {
        $utilitario = new MySQLUtil();
        $res = $utilitario->query('SELECT * FROM usuarios');
        return response()->json($res, 200);
    }
    public function store(Request $request)
    {
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        
        $strSQL = "INSERT usuarios (id, nombre, apellido) values ('$id', '$nombre', '$apellido');"; 
        $utilitario = new MySQLUtil();
        $utilitario->execute($strSQL);
        $respuesta = ["res" => "ok"];
        return response()->json(["res" => "ok"], 201);
    }
    public function show($id)
    {
        // replicar el index WHERE $id == usaurios.id
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
