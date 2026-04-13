      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{ asset('images/avatar.png') }}" alt="avatar"/>
              </div>
              <div class="profile-name">
                <p class="name">{{Auth::User()->surname}}</p>
                <p class="designation">{{Auth::User()->role}} <i class="fa fa-circle"></i></p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" wire:navigate href="{{ route('dashboard') }}">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">{{__('Dashboard')}}</span>
            </a>
          </li>

          {{-- SYSTEM  --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-system" aria-expanded="false" aria-controls="page-system">
              <i class="fas fa-desktop menu-icon"></i>
              <span class="menu-title">{{__('Sistema')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-system">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{__('Instituição')}}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{__('Bem-vindo')}}</a></li>
              </ul>
            </div>
          </li>

          {{-- SECURITY --}}
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-security" aria-expanded="false" aria-controls="page-security">
              <i class="fa fa-user-lock menu-icon"></i>
              <span class="menu-title">{{ __('Segurança') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-security">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Editar Perfil') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Mudar Senha') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Adicionar Usuário') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="{{ route('users.index') }}">{{ __('Todos Usuários') }}</a></li>
              </ul>
            </div>
          </li>

          {{-- FUNCIONÁRIO --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-employee" aria-expanded="false" aria-controls="page-employee">
              <i class="fa fa-users menu-icon"></i>
              <span class="menu-title">{{__('Funcionário')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-employee">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Novo') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Docentes') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Administrativos') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Força de Trabalho') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Todos') }}</a></li>
              </ul>
              </div>
          </li>

          {{-- ESTUDANTE --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-student" aria-expanded="false" aria-controls="page-student">
              <i class="fa fa-graduation-cap menu-icon"></i>
              <span class="menu-title">{{ __('Estudante') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-student">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Novo') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Actuais') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Antigos') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Finalistas') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Todos') }}</a></li>
              </ul>
            </div>
          </li>

          {{-- TURMA --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-class" aria-expanded="false" aria-controls="page-class">
              <i class="fas fa-chalkboard menu-icon"></i>
              <span class="menu-title">{{ __('Turma') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-class">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Actuais') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('EJA') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Regular') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:navigate href="">{{ __('Todas') }}</a></li>
              </ul>
            </div>
          </li>

          {{-- ANO LECTIVO --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-academic-year" aria-expanded="false" aria-controls="page-academic-year">
              <i class="fas fa-calendar-alt menu-icon"></i>
              <span class="menu-title">{{ __('Ano Lectivo') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-academic-year">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Novo') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Actual') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Anterior') }}</a></li>
                <li class="nav-item"> <a class="nav-link" wire:navigate href="">{{ __('Todos') }}</a></li>
              </ul>
              </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" wire:navigate href="">
              <i class="far fa-file-alt menu-icon"></i>
              <span class="menu-title">{{__('Ajuda')}}</span>
            </a>
          </li>
        </ul>
      </nav>