@extends('dashboard/index')

{{-- @section('title', 'Area de Atendimento Bio Control Pragas') --}}

{{-- @section('description', 'Descrição') --}}

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">::Veiculos</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button"
                    class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                    <svg class="bi">
                        <use xlink:href="#calendar3" />
                    </svg>
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

            <form action="" method="post">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>VEICULO: </label>
                            <select name="veiculo" id="veiculo" class="form-control">

                                <option value="#"> Selecione o veiculo</option>

                                <option value="motos"> Motos</option>
                                <option value="carros"> Carros</option>
                                <option value="caminhoes"> Caminhão</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>MARCA: </label>
                            <select name="marca1" id="marca1" class="form-control">
                            </select>

                        </div>

                        <div class="form-group col-md-4">
                            <label>MODELO </label>
                            <select name="modelo1" id="modelo1" class="form-control">

                            </select>
                            </label>
                        </div>

                        <div class="form-group col-md-3">
                            <label>ANO:</label>
                            <select name="ano1" id="ano1" class="form-control">

                            </select>

                        </div>



                        <div class="form-group col-md-3">
                            <label>Cor</label>
                            <input type="text" name="cor" class="form-control" />

                        </div>

                        <div class="form-group col-md-3">
                            <label>Placa</label>
                            <input type="text" name="placa" class="form-control" />

                        </div>

                        <div class="form-group col-md-3">
                            <label>Plano</label>
                            <select name="plano" id="plano" class="form-control">
                                @foreach ($planos as $plano )
                                <option value="{{ $plano['id'] }}"> {{ $plano['plano'] }} </option> 
                                @endforeach
                                
                            </select>
                           
                        </div>
                        <div class="form-group col-md-3">
                            <label>Assistencia 24 Horas</label>
                            <select name="assist_24hs" id="assist_24hs" class="form-control">
                                <option value="0"> Não</option>
                                <option value="1"> Sim</option>
                                
                            </select>
                           
                        </div>
                        <div class="form-group col-md-3">
                            <label>Central</label>
                            <select name="central" id="central" class="form-control">
                                <option value="0"> Não</option>
                                <option value="1"> Sim</option>
                                
                            </select>
                           
                        </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th>Cor</th>
                            <th>Placa</th>
                            <th>Renavam</th>
                            <th>Chassi</th>
                            <th>Plano</th>
                        </tr>
                    </thead>

                </table>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </main>

    <script>
        $(document).ready(function() {
            // Carregar marcas ao selecionar o tipo de veículo
            $('#veiculo').change(function() {
                let selectedVehicle = $(this).val();

                $.ajax({
                    url: "./../../escritorio/fipe/marca",
                    type: 'POST',
                    data: {
                        veiculo: selectedVehicle
                    },
                    success: function(response) {
                        console.log(response); // Verifique o formato dos dados recebidos

                        $('#marca1')
                    .empty(); // Limpa o select antes de adicionar os novos dados
                        $('#marca1').append('<option value="#">Selecione a marca</option>');
                        $('#marca1').append(response); // Insere diretamente o HTML recebido
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar as marcas:', error);
                    }
                });
            });

            // Carregar modelos ao selecionar a marca
            $('#marca1').change(function() {
                let selectedMarca = $(this).val();

                $.ajax({
                    url: "./../../escritorio/fipe/modelo",
                    type: 'POST',
                    data: {
                        marca: selectedMarca
                    },
                    success: function(response) {
                        console.log(response); // Verifique o formato dos dados recebidos

                        $('#modelo1')
                    .empty(); // Limpa o select antes de adicionar os novos dados
                        $('#modelo1').append('<option value="#">Selecione o modelo</option>');
                        $('#modelo1').append(response); // Insere diretamente o HTML recebido
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar os modelos:', error);
                    }
                });
            });

            // Carregar anos ao selecionar o modelo
            $('#modelo1').change(function() {
                let selectedModelo = $(this).val();

                $.ajax({
                    url: "./../../escritorio/fipe/ano",
                    type: 'POST',
                    data: {
                        modelo: selectedModelo
                    },
                    success: function(response) {
                        console.log(response); // Verifique o formato dos dados recebidos

                        $('#ano1').empty(); // Limpa o select antes de adicionar os novos dados
                        $('#ano1').append('<option value="#">Selecione o ano</option>');
                        $('#ano1').append(response); // Insere diretamente o HTML recebido
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar os anos:', error);
                    }
                });
            });
        });
    </script>
@endsection()
