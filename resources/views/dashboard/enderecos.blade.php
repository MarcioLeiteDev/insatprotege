@extends('dashboard/index')

{{-- @section('title' , 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description' , 'Descrição') --}}

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">::Endereços</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
          <svg class="bi"><use xlink:href="#calendar3"/></svg>
          This week
        </button>
      </div>
    </div>

    <div class="row">
      @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="col-12">
  <h3>Cliente</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>CPF</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $pessoa['nome']}}</td>
        <td>{{ $pessoa['cpf']}}</td>
      </tr>
    </tbody>
  </table>
</div>

<form action="{{ route('escritorio.enderecos.store' , [$id] )}}" method="post">
  @csrf
  <div class="row">
  <div class="form-group col-3">
    <label class="vinte">
        CEP
    </label>
    <input name="cep" type="text" id="cep" value="" class="form-control" maxlength="9" onblur="pesquisacep(this.value);" />
</div>

<div class="form-group col-7">
    <label>
        END.RES: </label>
    <input name="logradouro" type="text" id="logradouro" class="form-control" />
</div>
<div class="form-group col-md-2">
    <label>Numeroº</label>
    <input name="numero" type="text" id="numero" class="form-control" />

</div>

<div class="form-group col-md-3">
    <label>
        complementoO:
    </label>
    <input name="complemento" type="text" id="complemento" class="form-control" />
</div>

<div class="form-group col-md-3">
    <label> BAIRRO : </label>
    <input name="bairro" type="text" id="bairro" class="form-control" />
</div>

<div class="form-group col-md-2">
    <label>CIDADE: </label>

    <input name="cidade" type="text" id="cidade" class="form-control" />
</div>

<div class="form-group col-md-2">
    <label>ESTADO: </label>

    <input name="uf" type="text" id="uf" class="form-control" />
</div>

<div class="form-group col-md-2">
    <label>Tipo de Endereço: </label>

    <select name="tipo" id="tipo" class="form-control">
      <option value="residencial">Residencial</option>
      <option value="comercial">Comercial</option>
    </select>
</div>
<input type="hidden" name="id_pessoa" value="{{ $id }}">

<div class="form-group col-md-12">
    <input type="submit" value="+ CADASTRAR" class="btn btn-success p-2" />
</div>

</div>
</div>
</form>


    <table class="table">
      <thead >
        <tr class="bg bg-success">
          <th>CEP</th>
          <th>Logradouro</th>
          <th>Numero</th>
          <th>Complemento</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>UF</th>
          <th>Tipo</th>
        </tr>
      </thead>
      <tbody >
        @foreach($endereco as $valor)
        <tr class="bg bg-success">
          <td>{{ $valor['cep'] }}</td>
          <td>{{ $valor['logradouro'] }}</td>
          <td>{{ $valor['numero'] }}</td>
          <td>{{ $valor['complemento'] }}</td>
          <td>{{ $valor['bairro'] }}</td>
          <td>{{ $valor['cidade'] }}</td>
          <td>{{ $valor['uf'] }}</td>
          <td>{{ $valor['tipo'] }}</td>
        </tr>
        @endforeach
      </tbody>

    </table>

    <div class="col-">
     <a href="{{ route('escritorio.telefones.index' , [ $id ])}}"><button class="btn btn-success"> Pular Etapa </button></a> 
    </div>
 


  </main>

  <!-- Adicionando Javascript -->
<script type="text/javascript">
  function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('logradouro').value = ("");
      document.getElementById('bairro').value = ("");
      document.getElementById('cidade').value = ("");
      document.getElementById('uf').value = ("");

  }

  function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
          //Atualiza os campos com os valores.
          document.getElementById('logradouro').value = (conteudo.logradouro);
          document.getElementById('bairro').value = (conteudo.bairro);
          document.getElementById('cidade').value = (conteudo.localidade);
          document.getElementById('uf').value = (conteudo.uf);

      } //end if.
      else {
          //CEP não Encontrado.
          limpa_formulário_cep();
          alert("CEP não encontrado.");
      }
  }

  function pesquisacep(valor) {

      //Nova variável "cep" somente com dígitos.
      var cep = valor.replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if (validacep.test(cep)) {

              //Preenche os campos com "..." enquanto consulta webservice.
              document.getElementById('logradouro').value = "...";
              document.getElementById('bairro').value = "...";
              document.getElementById('cidade').value = "...";
              document.getElementById('uf').value = "...";


              //Cria um elemento javascript.
              var script = document.createElement('script');

              //Sincroniza com o callback.
              script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

              //Insere script no documento e carrega o conteúdo.
              document.body.appendChild(script);

          } //end if.
          else {
              //cep é inválido.
              limpa_formulário_cep();
              alert("Formato de CEP inválido.");
          }
      } //end if.
      else {
          //cep sem valor, limpa formulário.
          limpa_formulário_cep();
      }
  };
</script>


  @endsection()