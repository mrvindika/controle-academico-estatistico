<?php

use function Livewire\Volt\{state, computed, mount};

state(['gallery'=> [], 'about'=> []]);

mount(function(){
    $this->gallery= [
        [
            'img_src'=> '../../images/samples/300x300/1.jpg',
            'title'=> 'O Director',
            'description'=> 'Carmona Cativa'
        ],
            [
            'img_src'=> '../../images/samples/300x300/2.jpg',
            'title'=> 'S.P.E.R.H',
            'description'=> 'Justino Candieiro'
        ],
            [
            'img_src'=> '../../images/samples/300x300/3.jpg',
            'title'=> 'S.I.S.E',
            'description'=> 'Campos Cassessa'
        ],
            [
            'img_src'=> '../../images/samples/300x300/4.jpg',
            'title'=> 'S.C.T.I',
            'description'=> 'Amâncio Mateus'
        ],
    ];

    $this->about= [
        'title'=> 'Direcção Municipal da Educação do Cubal',
        'about'=> 
            'Seja bem-vindo ao portal oficial da Direcção Municipal da Educação do Cubal.
            Somos o órgão responsável por planear, coordenar e executar as políticas educativas no nosso município, 
            com o firme compromisso de garantir um ensino de qualidade, inclusivo e acessível a todos os cidadãos. 
            Trabalhamos diariamente para fortalecer o sistema de ensino local, desde o ensino primário ao II ciclo, 
            promovendo a valorização dos nossos quadros docentes e o desenvolvimento integral dos alunos. Acreditamos que a 
            educação é o motor principal para o progresso social e económico do Cubal.',
        'location'=> 'Estamos localizados na Rua 10 de Dezembro - Cubal - Benguela.',
    ];
});

?>


<div class="card bg-primary">
    {{-- TITLE --}}
    <x-slot name="title">{{ __('Sistema | bem-vindo') }}</x-slot>

    <div class="card-body">
        {{-- GALLERY --}}
        <div class="row">
            <h4 class="page-title text-danger">{{ __('Seja bem-vindo') }}</h4>
        </div>

        {{-- GALLERY --}}
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row portfolio-grid">
                                {{-- BLOCK 1 --}}
                                @foreach($gallery as $item)
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                                        <figure class="effect-text-in">
                                        <img src="{{ $item['img_src'] }}" alt="image">
                                        <figcaption>
                                            <h5 class="card-text">{{__($item['title'])}}</h5>
                                            <p>{{__($item['description'])}}</p>
                                        </figcaption>
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ABOUT --}}
        <div class="row">
            <div class="col-12">
                <h5 class="text-danger">
                    <i class="icon-sm fas fa-graduation-cap"></i>
                    {{ $about['title'] }}
                </h5>  
                <p class="text-justify text-white">{{ __($about['about']) }}</p>
                <p class="text-justify text-warning">{{ __($about['location']) }}</p>
            </div> 
        </div>
    </div>
</div>

