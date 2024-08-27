<?php

namespace App\Http\Controllers;

use App\Imports\ExcelDataImport;
use App\Models\Enderecos;
use App\Models\Pessoas;
use App\Models\Telefones;
use App\Models\User;
use App\Models\Veiculos;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExportController extends Controller
{
    public function index()
    {
        return view('dashboard.export');
    }

    public function import(Request $request)
    {
        ini_set('max_execution_time', 300);
        // Carrega os dados do arquivo e converte para array
        $data = Excel::toArray(new ExcelDataImport, $request->file('file'));

        $dadosDois = $data[1];

        // Arrays para armazenar os dados
        $arrayUser = [];
        $processedEmails = [];

        // Primeiro, cria os usuários únicos
        foreach ($dadosDois as $value) {
            if (!empty($value[12]) && filter_var($value[12], FILTER_VALIDATE_EMAIL) && !in_array($value[12], $processedEmails)) {
                $arrayUser[] = [
                    "nickname" => $value[1] ?? '',
                    'level' => 3,
                    'password' => bcrypt($value[29] ?? 'insat'), // Usa bcrypt para senha
                    'email' => $value[12] ?? '',
                ];

                $processedEmails[] = $value[12];
            }
        }

        $import = User::upsert($arrayUser, ['email'], ['nickname', 'password']);

        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dadosDois);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.pessoas');
        }

        return redirect()->back()->withErrors('Erro ao importar dados.');
    }

    public function pessoas(Request $request)
    {
        ini_set('max_execution_time', 300);
        // Obtém os dados da sessão
        $dados = session('dados', []);

        // Arrays para armazenar os dados
        $arrayPessoas = [];
        $processedEmails = [];

        // Primeiro, cria os usuários únicos
        foreach ($dados as $value) {
            if (!empty($value[12]) && filter_var($value[12], FILTER_VALIDATE_EMAIL) && !in_array($value[12], $processedEmails)) {
                $user_id = User::where('email', $value[12])->first();
                $arrayPessoas[] = [
                    "nome" => $value[1] ?? '',
                    "cpf" => $value[3] ?? '',
                    "cnpj" => $value[3] ?? '',
                    "user_id" => $user_id->id,
                ];

                $processedEmails[] = $value[12];
            }
        }

        $import = Pessoas::upsert($arrayPessoas, ['user_id'], ['nome', 'cpf', 'cnpj', 'dt_nascimento']);

        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dados);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.enderecos');
        }

        return redirect()->back()->withErrors('Erro ao importar dados.');
    }

    public function enderecos(Request $request)
    {
        ini_set('max_execution_time', 300);
        // Obtém os dados da sessão
        $dados = session('dados', []);

        // Arrays para armazenar os dados
        $arrayEnderecos = [];
        $processedEmails = [];

        // Primeiro, cria os usuários únicos
        foreach ($dados as $value) {
            if (!empty($value[12]) && filter_var($value[12], FILTER_VALIDATE_EMAIL) && !in_array($value[12], $processedEmails)) {
                $pessoa_id = Pessoas::where('nome', $value[1])->first();
                $arrayEnderecos[] = [
                    "logradouro" => $value[4] ?? '',
                    "numero" => $value[5] ?? '',
                    "complemento" => $value[6] ?? '',
                    "cep" => $value[10] ?? '',
                    "bairro" => $value[7] ?? '',
                    "cidade" => $value[8] ?? '',
                    "uf" => $value[8] ?? '',
                    "tipo" => $value[8] ?? '',
                    "id_pessoa" => $pessoa_id->id ?? '',

                ];

                $processedEmails[] = $value[12];
            }
        }

        $import = Enderecos::upsert($arrayEnderecos, ['id_pessoa'], ['logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'uf', 'tipo']);

        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dados);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.telefones');
        }

        return redirect()->back()->withErrors('Erro ao importar dados.');
    }


    public function telefones(Request $request)
    {
        ini_set('max_execution_time', 300);
        // Obtém os dados da sessão
        $dados = session('dados', []);



        // Arrays para armazenar os dados
        $arrayTelefones = [];
        $processedEmails = [];

        // Primeiro, cria os usuários únicos
        foreach ($dados as $value) {
            if (!empty($value[12]) && filter_var($value[12], FILTER_VALIDATE_EMAIL) && !in_array($value[12], $processedEmails)) {
                $pessoa_id = Pessoas::where('nome', $value[1])->first();
                $arrayTelefones[] = [
                    "tipo" => 1,
                    "numero" => $value[11] ?? '',
                    "id_pessoa" => $pessoa_id->id ?? '',


                ];

                $processedEmails[] = $value[12];
            }
        }

        $import = Telefones::upsert($arrayTelefones, ['id_pessoa'], ['numero', 'tipo']);



        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dados);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.veiculos');
        }

        return redirect()->back()->withErrors('Erro ao importar dados.');
    }


    public function veiculos(Request $request)
    {
        ini_set('max_execution_time', 900);
        // Obtém os dados da sessão
        $dados = session('dados', []);

        // dd($dados);
        // Arrays para armazenar os dados
        $arrayVeiculos = [];
        unset($dados[0]);
        foreach($dados as $value)
        {
            
            $pessoa_id = Pessoas::select('id')->where('nome', $value[1])->first();

            $valor = $value[26];

            if($valor === "."){
                $valor = 0;
            }else{
                $valor = $valor;
            }

            $vigencia = $value[34];

            $plano = '';

            if($vigencia === 12){
                $plano = 1;
            }
            if($vigencia === 24){
                $plano = 2;
            }
            if($vigencia === 36){
                $plano = 3;
            }
            if($vigencia === 0){
                $plano = 4;
            }

            $excelDate = intval($value[32]); // Data no formato Excel
            $dateTime = Date::excelToDateTimeObject($excelDate);
            $formattedDate = $dateTime->format('Y-m-d'); // Formato de data do BD (YYYY-MM-DD)

            $central = 0;
            if($value[21] !== "NÃO"){
                $central = 1;
            }

            $assist = 0;
            if($value[22] !== "NÃO"){
                $assist = 1;
            }

            $status = 0;
            if($value[22] !== "NÃO"){
                $status = 1;
            }

            $arrayVeiculos[] = [
                "id_pessoa" => $pessoa_id->id ?? '',
                "modelo" => $value[17] ?? '',
                "marca" => $value[16] ?? '',
                "ano" => $value[15] ?? '',
                "cor" => $value[14] ?? '',
                "placa" => $value[13] ?? '',
                "chassi" => 'no' ?? '',
                "plano" => $plano ?? '',
                "valor" => $valor ?? '',
                "dt_instalacao" => $formattedDate ?? '',
                "central" => $central ?? '',
                "assist_24hs" => $assist ?? '',
                "status" => $status ?? '',
                "inicio" => $formattedDate ?? '',

                "nomeVendedor" => $value[35] ?? '',
            ];
        }
        // dd($arrayVeiculos);

        $import = Veiculos::upsert($arrayVeiculos, ['placa'], ['modelo', 'marca' , 'ano' , 'cor' , 'plano' , 'valor' , 'dt_instalacao' , 'central']);



        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dados);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.index');
        }
    }
}
