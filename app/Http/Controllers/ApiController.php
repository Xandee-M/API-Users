<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    function appError($info) //Tratar mensagens de erro retornadas para na API
    {
        return response()->json(['error' => $info], 403);
    }

    // CRUD Produtos

    public function create(Request $request)
    {

        try {

            if ( is_null($request->name)  || is_null($request->email)  || is_null($request->password) ) //Verificar se algum dos campos de criação está vazio
                return ApiController::appError('Parâmetros vazios não são permitidos ao criar usuários.');

            $verifyExist = Users::where('email', '=', $request->email); //Verificar se já existe um usuário com o email inserido.
            if ($verifyExist->exists())
                return ApiController::appError('Já existe um usuário com o endereço de email inserido.');

            $create = Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return  response()->json(['success' => 'Usuário cadastro com sucesso!', 'user' => $create->get()], 200);
        } catch (Exception $e) {
            return ApiController::appError(`Ocorreu um erro ao criar o usuário: {$e}`);
        }
    }

    public function delete(Request $request) //Deleta um produto no banco
    {
        try {
            if (!$request->id) //Retornar se a chave passada na API não for um id.
                return ApiController::appError('O parâmetro está incorreto, o parâmetro correto seria { id: user_id }.'); 

            $delete = Users::where('id', $request->id); //Buscar produto

            if (!$delete->exists()) //Retornar se o produto não existir.
                return ApiController::appError('Esse usuário não existe ou ja foi deletado.'); 
            else
                $delete->delete(); //Se existir, deletar

            return  response()->json(['success' => 'Usuário deletado com sucesso.'], 200);
        } catch (Exception $e) {
            return ApiController::appError(`Ocorreu um erro ao deletar o usuário: {$e}`);
        }
    }

    public function update(Request $request)
    {
        try {

            if (!$request->id) //Retornar se a chave passada na API não for um id.
                return ApiController::appError('O parâmetro está incorreto, o parâmetro correto seria { id: user_id }.'); 

            $update = Users::where('id', '=', $request->id);

            if (!$update->exists()) //Buscar se produto existe no banco com este id.
                return  ApiController::appError('Esse usuário não existe.'); 

            $verifyExist = Users::where('id', '!=', $request->id)->where('email', '=', $request->name); //Verificar se já existe um produto de mesmo nome salvo.

            if ($verifyExist->exists())
                return ApiController::appError('Existe um outro usuário utilizando o endereço de email inserido');

            //Filtrar campos que receberão o update
            $array = array();
            $keys = ['name', 'email', 'password'];
            for ($i = 0; $i < count($keys); $i++) {
                if (!is_null($request[$keys[$i]])) {
                    if($keys[$i] == 'password'){
                        $array[$keys[$i]] = Hash::make($request[$keys[$i]]);
                    }else{
                        $array[$keys[$i]] = $request[$keys[$i]];
                    }
                }
            }

            $update->update($array);

            return  response()->json(['success' => 'O usuário foi atualizado com sucesso.', 'user' => $update->get()], 200);
        } catch (Exception $e) {
            ApiController::appError(`Ocorreu um erro ao atualizar o usuário: $e`);
        }
    }

    public function list(Request $request) // Faz a listagem dos produtos existentes no banco
    {
        try {

            if (!$request->id) //Retornar se a chave passada na API não for um id.
                return ApiController::appError('O parâmetro está incorreto, o parâmetro correto seria { id: user_id }.'); 

            $show = Users::where('id', '=', $request->id)->get();
            if (count($show) == 0) // Se não existir produtos, retornar mensagem de erro
                return ApiController::appError('Esse usuário não existe.');
            else
                return  response()->json(['users' => $show], 200);
        } catch (Exception $e) {
            return ApiController::appError(`Ocorreu um erro ao listar esse usuário: {$e}`);
        }
    }

    public function listAll() // Faz a listagem dos produtos existentes no banco
    {
        try {
            $show = Users::get();
            if (count($show) == 0) // Se não existir produtos, retornar mensagem de erro
                return ApiController::appError('Não há nenhum usuário cadastrado.');
            else
                return  response()->json(['users' => $show], 200);
        } catch (Exception $e) {
            return ApiController::appError(`Ocorreu um erro ao recuperar a listagem de usuários: {$e}`);
        }
    }
}
