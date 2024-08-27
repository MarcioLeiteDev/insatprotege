@extends('dashboard/index')

{{-- @section('title' , 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description' , 'Descrição') --}}

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">::Planos</h1>
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
  <svg class="bi"><use xlink:href="#people"/></svg>  Adicionar Plano
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Planos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('escritorio.planos.store') }}" method="post">
          @csrf
          <div class="row">

            <h3>Planos</h3>

            <div class="col-4">
              <label for="plano">Plano</label>
              <input type="text" name="plano" id="plano" class="form-control">
            </div>
            <div class="col-4">
              <label for="prazo">Prazo</label>
              <input type="text" name="prazo" id="prazo" class="form-control">
            </div>

            <div class="col-4">
              <label for="valor">Valor</label>
              <input type="text" name="valor" id="valor" class="form-control">
            </div>          
   
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
          <th>Plano</th>
          <th>Prazo</th>
          <th>Valor</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
      @foreach($planos as $plano)
        <tr class="bg bg-success">
          <td>{{ $plano['plano']}}</td>
          <td>{{ $plano['prazo']}}</td>
          <td>{{ $plano['valor']}}</td>
          <td>Editar</td>
          <td>Deletar</td>
        </tr>
        @endforeach
      </tbody>

    </table>
 


  </main>

  @endsection()