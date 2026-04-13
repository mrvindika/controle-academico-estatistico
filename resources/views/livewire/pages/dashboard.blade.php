<?php

use function Livewire\Volt\{state};

//

?>

<div>
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Dashboard') }} </x-slot>

    {{-- SCRIPTS --}}
    <x-slot name="scripts">
        <script type="text/javascript" src="{{ asset('assets/template/dashboard.js') }}" charset="UTF-8"></script>
    </x-slot>

    {{-- INFO CARDS --}}
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-chalkboard-teacher mr-2"></i>{{__('Docentes')}}
                            </p>
                            <h2>{{__('56')}}</h2>
                            <label class="badge badge-outline-danger badge-pill">{{__('Reduziu 30%')}}</label>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-users mr-2"></i>{{__('Administrativos')}}
                            </p>
                            <h2>{{__('43')}}</h2>
                            <label class="badge badge-outline-success badge-pill">{{__('Aumentou 12%')}}</label>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fa fa-chalkboard mr-2"></i>{{__('Turmas')}}
                            </p>
                            <h2>{{__('29')}}</h2>
                            <label class="badge badge-outline-success badge-pill">{{__('Aumentou 2.7%')}}</label>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-graduation-cap mr-2"></i>{{__('Matriculados')}}
                            </p>
                            <h2>{{__('1300')}}</h2>
                            <label class="badge badge-outline-success badge-pill">{{__('Aumentou 17%')}}</label>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-book-reader mr-2"></i>{{__('Avaliados')}}
                            </p>
                            <h2>{{__('123')}}</h2>
                            <label class="badge badge-outline-success badge-pill">{{__('Aumentou 10%')}}</label>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-tasks mr-2"></i>{{__('Aprovados')}}
                            </p>
                            <h2>{{__('898')}}</h2>
                            <label class="badge badge-outline-danger badge-pill">{{__('Reduziu 16%')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART CARDS 1 --}}
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>{{__('Ultimas Matrículas')}}
                    </h4>
                    <canvas id="grafico-ultimas-matriculas"></canvas>
                    <div id="grafico-ultimas-matriculas-legend" class="grafico-ultimas-matriculas-legend"></div>                  
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>{{__('Ultimos Aproveitamentos')}} 
                    </h4>
                    <canvas id="grafico-ultimos-aproveitamentos"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART CARDS 2 --}}
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i> {{__('Actual Matrícula')}}
                    </h4>
                    <canvas id="grafico-matricula-actual"></canvas>                  
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>{{__('Actual Aproveitamento')}} 
                    </h4>
                    <canvas id="grafico-aproveitamento-actual"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
