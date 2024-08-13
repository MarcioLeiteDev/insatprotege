@extends('dashboard/index')

{{-- @section('title' , 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description' , 'Descrição') --}}

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">::Telefones</h1>
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

<form action="{{ route('escritorio.telefones.store' , [ $id ] )}}" method="post">
  @csrf
  <div class="row">
    <div class="col-4">
      <label for="tipo">Tipo</label>
      <select name="tipo" id="tipo" class="form-control">
        <option value="1">Celular</option>
        <option value="2">Fixo</option>
      </select>
    </div>
    <div class="col-4">
      <label for="numero">Numero</label>
      <input type="text" name="numero" id="numero" class="form-control">
    </div>
    <div class="col-4">
      <label for="">.</label>
      <input type="hidden" name="id_pessoa" value="{{ $id }}">
      <input type="submit" value="cadastrar" class="btn btn-success">
    </div>
  </div>
</form>

    <table class="table">
      <thead >
        <tr class="bg bg-success">
          <th>Telefone</th>
          <th>Tipo</th>
        </tr>
      </thead>
      <tbody >
        @foreach($telefones as $valor)
        <tr>
          <td>{{ $valor['numero']}}</td>
          <td>
            @if($valor['tipo'] === 1)
            Celular
            @endif
            @if($valor['tipo'] === 2)
            Fixo
            @endif
           </td>
        </tr>
        @endforeach
      </tbody>

 

    </table>
 
    <div class="col-12">
      <a href="{{ route('escritorio.veiculos.index' , [ $id ])}}"><button class="btn btn-info">Pular Etapa</button></a>  
      </div>

  </main>

  @endsection()