<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class toolsController extends Controller
{
    /**
    * @OA\Get(
    *     tags={"/tools"},
    *     description="Lista de ferramentas",
    *     path="/tools",
    *     @OA\Parameter(
    *         name="tag",
    *         in="query",
    *         @OA\Schema(
    *            type="string"
    *          ),
    *         description="filtrar ferramentas utilizando uma busca por tag",
    *         required=false,
    *       ),
    *    @OA\Response(response="200", description="Retorna uma lista de ferramentas"),
    *    @OA\Response(response="404", description="Nenhuma ferramenta foi encontrado no banco de dados")
    * )
    */

    public function index(Request $request)
    {
        $filter = '';

        //Verifica se foi passado busca por tag na url
        if (isset($request->tag)) {

            //busca o id da tag solicitada
            $tag = DB::table('tags')
                ->where('tags.tag', '=', $request->tag)
                ->select('tags.id')
                ->get();

            //Verifica se o retorno foi vazio, ou seja, nenhum registro encontrado
            //Caso verdadeiro, retorna um array vazio com status 404
            if ($tag->isEmpty()) {
                $tools = [];
                return response($tools, 404);
            }

            //Bassa o id para a variavel filter
            $filter = $tag[0]->id;
        }

        //Busca todas as ferramentas da tabela tools
        $tools = DB::table('tools')
            ->when($filter, function ($query, $filter) {
                return $query
                    ->join('tools_tags', 'tools_tags.tool_id', '=', 'tools.id')
                    ->where('tools_tags.tag_id', '=', $filter);
            })
            ->select('tools.id', 'tools.title', 'tools.link', 'tools.description')
            ->get();



        // Percorre o array $tools
        foreach ($tools as $key => $tool) {

            //Busca as marcações por ferramenta
            $tagsAll = DB::table('tools_tags')
                ->join('tags', 'tags.id', '=', 'tools_tags.tag_id')
                ->where('tools_tags.tool_id', '=', $tool->id)
                ->select('tags.tag')
                ->get();

            //Cria um array vazio para armazenar as marcações
            $tags = [];

            //Percorre o array $tagsAll extraindo e armazendo a desctrição de cada uma.
            foreach ($tagsAll as $tag) {
                array_push($tags, $tag->tag);
            }

            //Adicona todas as marcações da ferramenta
            $tools[$key]->tags = $tags;
        }


        return response()->json($tools, 200);
    }


    public function show($tag)
    {
    }


    public function store(Request $request)
    {
        //
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
