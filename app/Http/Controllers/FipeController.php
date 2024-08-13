<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function marca(Request $request)
    {
        // dd('marca'/);
        $puxa = $_POST["veiculo"];
 //$puxa = "motos";
 
 

            $json_file = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$puxa}/marcas");
            $json_str = json_decode($json_file, true);
            $itens = $json_str;

            $d = "|";

            foreach ($itens as $e) {

                echo "<option value=\"{$e['nome']}{$d}{$e['codigo']}{$d}{$puxa}\">{$e['nome']} </option>";
            }

    }

    public function modelo(Request $request)
    {
        $puxa = $_POST['marca'];
 
        $trata = explode("|", $puxa);

        // dd($trata);
        
        //echo "https://parallelum.com.br/fipe/api/v1/{$trata['2']}/marcas/{$trata['1']}/modelos";
        
       
                   $json_file = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$trata['2']}/marcas/{$trata['1']}/modelos");
                   $json_str = json_decode($json_file, true);
                    $itens = $json_str;
       
          
                  // print_r($itens);
       
                   
       $arr_result = $itens;
       foreach($arr_result as $data)
       {
       if(is_array($data))
       {
       foreach($data as $other_data)
       {
       echo "<option value='{$trata['2']}|{$trata['1']}|{$other_data['codigo']}|{$other_data['nome']}'> {$other_data['nome']} </option>" ;
       }
       }
       else
       {
       echo $data, '<br/>';
       }
       }
       
    }

   
}
