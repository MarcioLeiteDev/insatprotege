<?php

namespace App\Http\Controllers;

use App\Imports\ExcelDataImport;
use App\Models\Enderecos;
use App\Models\Observacao;
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

        // dd($dados);

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

        $import = Pessoas::upsert($arrayPessoas, ['nome'], ['user_id', 'cpf', 'cnpj' ]);

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

        $import = Enderecos::upsert($arrayEnderecos, ['logradouro'], ['id_pessoa', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'uf', 'tipo']);

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

        $import = Telefones::upsert($arrayTelefones, ['numero'], ['id_pessoa', 'tipo']);



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
        ini_set('max_execution_time', 900); // Aumenta o tempo de execução
        $dados = session('dados', []);
    
        $arrayVeiculos = [];
        unset($dados[0]);
    
        foreach ($dados as $value) {
            $pessoa = Pessoas::select('id')->where('nome', $value[1])->first();
            $pessoa_id = $pessoa ? $pessoa->id : null;
    
            $valor = $value[26];
            if ($valor === "." || $valor === "" || !is_numeric($valor)) {
                $valor = 0;
            } else {
                $valor = number_format((float)$valor, 2, '.', ''); // Formata o valor como decimal com 2 casas decimais
            }
    
            $vigencia = $value[34];
            $plano = match($vigencia) {
                12 => 1,
                24 => 2,
                36 => 3,
                0 => 4,
                default => ''
            };
    
            $excelDate = intval($value[32]);
            $dateTime = Date::excelToDateTimeObject($excelDate);
            $formattedDate = $dateTime->format('Y-m-d');
    
            $central = ($value[21] !== "NÃO") ? 1 : 0;
            $assist = ($value[22] !== "NÃO") ? 1 : 0;
            $status = ($value[22] !== "NÃO") ? 1 : 0;
    
            if ($pessoa_id !== null) {
                $arrayVeiculos[] = [
                    "id_pessoa" => $pessoa_id,
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
        }
    
        $chunks = array_chunk($arrayVeiculos, 100);
    
        foreach ($chunks as $chunk) {
          $import =  Veiculos::upsert($chunk, ['placa'], [
                'id_pessoa',
                'modelo',
                'marca',
                'ano',
                'cor',
                'plano',
                'valor',
                'dt_instalacao',
                'central',
                'assist_24hs',
                'status',
                'inicio',
                'nomeVendedor',
            ]);
        }

        if ($import) {
            // Armazena dados na sessão
            session()->flash('dados', $dados);

            // Redireciona para a nova rota
            return redirect()->route('escritorio.export.obs');
        }

    
        // session()->flash('dados', $dados);
        // return redirect()->route('escritorio.export.index')->with('success', 'Importação realizada com Sucesso!');
    }

    public function obs(Request $request)
    {
        ini_set('max_execution_time', 900); // Aumenta o tempo de execução
        $dados = session('dados', []);

        // dd($dados);
    
        $arrayVeiculos = [];
        unset($dados[0]);
    
        foreach ($dados as $value) {
            $veiculo = Veiculos::select('id')->where('placa', $value[13])->first();
            $veiculo_id = $veiculo ? $veiculo->id : null;

    
            $excelDate = intval($value[32]);
            $dateTime = Date::excelToDateTimeObject($excelDate);
            $formattedDate = $dateTime->format('Y-m-d');

    
            if ($veiculo_id !== null) {
                $arrayObs[] = [
                    "id_veiculo" => $veiculo_id,
                    "equipamento" => $value[24] ?? '',
                    "Observacoes" => $value[36] ?? '',
                    "chip" => $value[25] ?? '',
                    "login" => $value[29] ?? '',
                    "senha" => $value[30] ?? '',
                    "contrato" => $value[2]  ?? '',
                    
                ];
            }
        }
    
        $chunks = array_chunk($arrayObs, 100);
    
        foreach ($chunks as $chunk) {
           Observacao::upsert($chunk, ['equipamento'], [
                'Observacoes',
                'chip',
                'login',
                'senha',
                'contrato',
            ]);
        }

    
        session()->flash('dados', $dados);
        return redirect()->route('escritorio.export.index')->with('success', 'Importação realizada com Sucesso!');
    }
    
    
   
}
