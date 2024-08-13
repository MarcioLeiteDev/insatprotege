@extends('dashboard/index')

{{-- @section('title' , 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description' , 'Descrição') --}}

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">::Clientes</h1>
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
      <div class="col-10"></div>
      <div class="col-2">
        
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <svg class="bi"><use xlink:href="#people"/></svg>  Adicionar Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Usuários</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('escritorio.users.storeCliente') }}" method="post">
          @csrf
          <div class="row">

            <h3>Login</h3>

            <div class="col-6">
              <label for="email">E-mail</label>
              <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="col-6">
              <label for="password">Senha</label>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <h3>Dados Pessoais</h3>
            <div class="col-12">
              <label for="nome">Nome</label>
              <input type="text" name="nome" id="nome" class="form-control">
            </div>
            <div class="col-6">
              <label for="rg">RG</label>
              <input type="text" name="rg" id="rg" class="form-control">
            </div>
            <div class="col-6">
              <label for="cpf">CPF</label>
              <input type="text" name="cpf" id="cpf" class="form-control">
            </div>
            <div class="col-6">
              <label for="cnpj">CNPJ</label>
              <input type="text" name="cnpj" id="cnpj" class="form-control">
            </div>
            <div class="col-6">
              <label for="dt_nascimento">Data Nascimento</label>
              <input type="date" name="dt_nascimento" id="dt_nascimento" class="form-control">
            </div>

            <input type="hidden" name="level" value="3">
            <div class="col-12">
              <input type="submit" value="Cadastrar" class="btn btn-success">
            </div>
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">X</button>
       
      </div>
    </div>
  </div>
</div>
      </div>
    </div>

    <table class="table">
      <thead >
        <tr class="bg bg-success">
          <th>Nome</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Veiculos</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>

    </table>
 


  </main>

  @endsection()