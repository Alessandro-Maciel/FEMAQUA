<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\models\Tag;
use App\models\Tag_Tools;
use App\models\Tool;
use Illuminate\Support\Facades\Validator;



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
     *    security={{"bearerAuth":{}}},
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
                return response('Nenhum registro foi encontrado', 404);
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
            $tools[$key]->tags = $this->buscarTags($tool);
        }

        return response()->json($tools, 200);
    }


    private function buscarTags($tool)
    {

        //Busca as marcações da ferramenta
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

        //retorna as tags
        return $tags;
    }


    /**
     * @OA\Get(
     *     tags={"/tools"},
     *     description="Exibir detalhes de uma ferramenta",
     *     path="/tools/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(
     *            type="integer"
     *          ),
     *         description="Realizar busca pelo id da ferramenta",
     *         required=true,
     *       ),
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(response="200", description="Retorna os detalhes da ferramenta"),
     *    @OA\Response(response="404", description="Nenhuma ferramenta foi encontrado no banco de dados")
     * )
     */


    public function show($id)
    {
        $tool = DB::table('tools')
            ->where('tools.id', '=', $id)
            ->select('tools.id', 'tools.title', 'tools.link', 'tools.description')
            ->get();

        //Verifica se o retorno foi vazio, ou seja, nenhum registro encontrado
        //Caso verdadeiro, retorna um array vazio com status 404
        if ($tool->isEmpty()) {
            return response('Nenhum registro foi encontrado', 404);
        }

        $tool[0]->tags = $this->buscarTags($tool[0]);

        return response()->json($tool[0], 200);
    }



    /**
     * @OA\Post(
     *     tags={"/tools"},
     *     description="Criação de nova ferramenta",
     *     path="/tools",
     *      @OA\RequestBody(
     *            @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="title",type="string"),
     *               @OA\Property(property="link",type="string"),
     *               @OA\Property(property="description",type="string"),
     *               @OA\Property(
     *                  property="tags",
     *                  type="array",
     *                  @OA\Items(),
     *              ),
     *            )
     *        )
     *      ),
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(response="201", description="Opecação bem sucedida. Ferramenta criada com sucesso"),
     *    @OA\Response(response="400", description="Sintaxe JSON inválida")
     * )
     */

    public function store(Request $request)
    {
        //Verificar se o schema JSON passado é válido
        if ($this->validatorShema($request->all())->fails()) {
            return response()->json("Sintaxe inválida", 400);
        } else {
            //Cria uma nova ferramenta
            $newTool = new Tool();
            $newTool->title = $request->title;
            $newTool->link = $request->link;
            $newTool->description = $request->description;
            $newTool->save();

            //Percorre o array tags
            foreach ($request->tags as $tag) {
                //Verifica se a tag já está cadastrada
                $returnTag =  DB::table('tags')
                    ->where('tags.tag', '=', $tag)
                    ->select('tags.id')
                    ->get();

                //Verifica se foi retornado alguma tag
                if ($returnTag->isEmpty()) {
                    //Cria uma nova Tag
                    $newTag = new Tag();
                    $newTag->tag = $tag;
                    $newTag->save();

                    //salva a tag e a tool na tabela de referência cruzada
                    $newTagTools = new Tag_Tools();
                    $newTagTools->tool_id = $newTool->id;
                    $newTagTools->tag_id = $newTag->id;
                    $newTagTools->save();
                } else {
                    //salva a tag e a tool na tabela de referência cruzada
                    $newTagTools = new Tag_Tools();
                    $newTagTools->tool_id = $newTool->id;
                    $newTagTools->tag_id = $returnTag[0]->id;
                    $newTagTools->save();
                }
            }

            //Monta o objeto de retorno
            $response = [
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'tags' => $request->tags,
                'id' => $newTool->id
            ];

            return response()->json($response, 201);
        }
    }

    private function validatorShema($data)
    {
        //retorna se o schema JSON passado é válido
        return Validator::make(
            $data,
            [
                'title' => 'required | string | max:255',
                'link' => 'required | string | max:255',
                'description' => 'required | string | max:255',
                'tags' => 'required | array'
            ]
        );
    }

    /**
     * @OA\Delete(
     *     tags={"/tools"},
     *     description="Excluir ferramenta",
     *     path="/tools/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(
     *            type="integer"
     *          ),
     *         description="Realizar a exclusão pelo id da ferramenta",
     *         required=true,
     *       ),
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(response="200", description="Operação bem sucedida"),
     * )
     */


    public function destroy($id)
    {

        //Exclui os registro da tabela de referência cruzada que tem o id da ferramenta
        DB::table('tools_tags')
            ->where('tools_tags.tool_id', '=', $id)
            ->delete();

        //Exclui a ferramenta
        DB::table('tools')
            ->where('tools.id', '=', $id)
            ->delete();


        return response()->json("{}", 200);
    }
}
