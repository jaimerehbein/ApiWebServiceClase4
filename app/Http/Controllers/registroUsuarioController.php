<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MySQLUtil;

class registroUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "SELECT usuarios.nombre as nombreusuario,".
                 "usuarios.apellido, encuentros.nombre as nombreencuentro, encuentros.fecha ".
                 "FROM registrousuario ".
                 "INNER JOIN encuentros on encuentros.id = registrousuario.idencuentro ".
                 "INNER JOIN usuarios on usuarios.id = registrousuario.idUsuario; ";

        $utilitario = new MySQLUtil();
        $res = $utilitario->query($query);
        return response()->json($res, 200);
    }
    public function store(Request $request)
    {
        $idUsuario = $request->input('idusuario');
        $idevento = $request->input('idevento');

        $strSQL = "INSERT registrousuario (idusuario, idencuentro) values ('$idUsuario', '$idevento');";
        $utilitario = new MySQLUtil();
        $utilitario->execute($strSQL);
        $respuesta = ["res" => "oki", "sql" => $strSQL];
        return response()->json($respuesta, 201);
    }
    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($idusuarioevento)
    {
        $arr = explode("___", $idusuarioevento);
        $idUsuario = $arr[0];
        $idEvento = $arr[1];

        $utilitario = new MySQLUtil();

        $query = "DELETE FROM registrousuario ".
                 "WHERE idusuario = '$idUsuario' and ".
                 "idencuentro = '$idEvento'; ";

        $res = $utilitario->execute($query);

        return response()->json(["res"=>"ok", "query" => $query], 200);
    }
}
