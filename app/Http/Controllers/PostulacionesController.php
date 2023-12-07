<?php

namespace App\Http\Controllers;

use App\Models\Postulaciones;
use App\Models\Trabajos;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostulacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = auth()->user();
        $postulaciones = Postulaciones::where('iduser', $usuario->id)->paginate(5); //->paginate(10);
        return view('postulaciones.index', compact('postulaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = auth()->user();
        $postulaciones = Postulaciones::create([
            //'estado' => true,
            //'motivo' => 'Cumple con todos los requisitos(Prueba)',
            'idtrabajo' => $request->idtrabajo,
            'iduser' => $usuario->id,
        ]);

        return redirect()->route('postulaciones.index')->with(['success' => 'Postulación realizada con éxito.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trabajo = Trabajos::find($id);
        $postulaciones = Postulaciones::where('idtrabajo', $trabajo->id)->paginate(10);

        return view('postulaciones.show', compact('postulaciones', 'trabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postulacion = Postulaciones::find($id);
        $client = new Client();

        $cv_user = $postulacion->usuario->textcv;

        $oferta_laboral = $this->obtenerOfertaLaboralPorId($postulacion->idtrabajo);

        $api_key = env('OPENAI_API_KEY');

        $url = env('OPENAI_API_URL');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ];

        $body = [
            "model" => "gpt-4-1106-preview",
            "messages" => [
                [
                    "role" => "system",
                    "content" =>  "Tú eres un analizador de CV que puntúa en base a la oferta laboral y el texto extraído de un CV. Lo único que tienes que hacer es, SIENDO SUPER ULTRA ESTRICTO, evaluar la similitud entre este currículum y la oferta laboral, leyendo cuidadosamente, y darme un porcentaje de qué tan apto es, por favor piensa 10 veces antes de decirme el porcentaje, sin equivocarte. Se breve ultra mega breve"
                ],
                [
                    "role" => "system",
                    "content" =>  "Algo asi debe ser la respuesta 'Similitud con la oferta laboral: 60% \n Motivo: Descripción corta'"
                ],
                [
                    "role" => "user",
                    "content" => "Hola, Primero te pasare el CV y luego la oferta en el mismo texto. \n CV: " . $cv_user . " " . $oferta_laboral
                ]
            ]
        ];



        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $body,
        ]);

        $result = json_decode($response->getBody(), true);


        // Variables para almacenar la información
        $similitudCompleta = '';
        $similitudNumero = '';
        $motivo = '';

        if (isset($result['choices'][0]['message']['content'])) {
            // Obtener el contenido completo del mensaje de respuesta
            $similitudCompleta = $result['choices'][0]['message']['content'];

            // Utilizar expresiones regulares para extraer la información deseada
            if (preg_match('/Similitud con la oferta laboral: (\d+)%/', $similitudCompleta, $matches)) {
                $similitudNumero = $matches[1];
            }
            
            // Imprimir la información para verificar
            //dd($similitudCompleta, $similitudNumero);

            // También puedes extraer el motivo si tiene un patrón específico
            // Por ejemplo, si el motivo siempre sigue después de "Motivo: "
            if (preg_match('/Motivo: (.+)$/m', $similitudCompleta, $matchesMotivo)) {
                $motivo = trim($matchesMotivo[1]);
            }
            if($similitudNumero>=50){
                $postulacion->estado = true;
                $postulacion->motivo = $motivo;    
                $postulacion->save();               
            }else{
                $postulacion->estado = false;
                $postulacion->motivo = $motivo;    
                $postulacion->save();
            }
            // Imprimir el motivo
            //dd($motivo);
        }

        //return redirect()->route('postulaciones.show/{$postulacion->trabajo->id}');
        return redirect()->route('postulaciones.show', $postulacion->idtrabajo);
    }
    public function obtenerOfertaLaboralPorId($idOfertaLaboral)
    {
        // Ejecuta la consulta SQL con la cláusula WHERE
        $ofertaLaboral = DB::select("
            SELECT
                'Oferta Laboral - ' || cargo || E'\n' ||
                'Responsabilidades: ' || array_to_string(responsabilidades, ', ') || E'\n' ||
                'Requisitos: ' || array_to_string(requisitos, ', ') || E'\n' ||
                'Salario: ' || salario::TEXT || E'\n' ||
                'Vacancias: ' || vacancia::TEXT || E'\n' ||
                'Fecha de inicio: ' || fecha::TEXT || E'\n' ||
                'Fecha de fin: ' || COALESCE(fechafin::TEXT, 'No especificada') || E'\n' ||
                'Estado: ' || CASE WHEN estado THEN 'Activo' ELSE 'Inactivo' END || E'\n' ||
                'Categoría: ' || categoria AS oferta_laboral
            FROM trabajos
            WHERE id = :id
        ", ['id' => $idOfertaLaboral]);

        // Verifica si se encontró una oferta laboral con el ID dado
        if (!empty($ofertaLaboral)) {
            // Accede a la oferta laboral como una propiedad del primer resultado
            $ofertaLaboralTexto = $ofertaLaboral[0]->oferta_laboral;

            // Devuelve el resultado o realiza alguna acción adicional según tus necesidades
            return $ofertaLaboralTexto;
        } else {
            // Maneja el caso en el que no se encuentre una oferta con el ID dado
            return "No se encontró una oferta laboral con el ID $idOfertaLaboral.";
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        return redirect()->route('postulaciones.index')->with(['success' => 'Postulación actualizada con éxito.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showPostulaciones($id)
    {

        $postulaciones = Postulaciones::where('idtrabajo', $id)->paginate(5); //->paginate(10);
        return view('postulaciones.index', compact('postulaciones'));
    }
}
