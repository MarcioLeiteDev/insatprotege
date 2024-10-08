@extends('dashboard/index')

{{-- @section('title' , 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description' , 'Descrição') --}}

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">::Dashboard </h1>
      {{-- {{ auth()->user()->level }} --}}
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


    <div class="box">
      <div class="box-content">
        <h1>Vendas</h1>
        <table class="table">
        </thead>
        <tr>
          <th>Data</th>
          <th>Cliente</th>
          <th>Status</th>
        </tr>
      </thead>
          <tbody>
            <tr>
              <td>Data</td>
              <td>Cliente</td>
              <td>Status</td>
            </tr>

        </table>
      </div>
      <div class="box-content">
        <h1>Serviços</h1>
      </div>
     
    </div>

    <div class="box">
      <div class="box-content">
        <h1>Cobranças à Receber</h1>
      </div>
      <div class="box-content">
        <h1>Cobranças Vencidas</h1>
      </div>
      <div class="box-content">
        <h1>Comissões</h1>
      </div>
     
    </div>
  </main>

  @endsection()