<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/')? 'active':'' }}">
                    {{ HTML::link(URL::route('home'), 'Inicio') }}
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                @if(Auth::check())
                    @if(Auth::user()->can('users:view'))
                        <li class="dropdown {{ Request::is('users*')? 'active':'' }}">
                            {{ HTML::link(URL::route('users.index'), 'Usuarios', ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>'false']) }}
                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Request::is('users*')? 'active':'' }}">
                                    {{ HTML::link(URL::route('users.index'), 'Lista de Usuarios') }}
                                </li>
                                @if(Auth::user()->can('users:create'))
                                    <li class="{{ Request::is('users/create')? 'active':'' }}">
                                        {{ HTML::link(URL::route('users.create'), 'Nuevo Usuario') }}
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->can('roles:view'))
                        <li class="dropdown {{ Request::is('roles*')? 'active':'' }}">
                            {{ HTML::link(URL::route('roles.index'), 'Roles', ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>'false']) }}
                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Request::is('roles')? 'active':'' }}">
                                    {{ HTML::link(URL::route('roles.index'), 'Lista de Roles') }}
                                </li>
                                @if(Auth::user()->can('roles:create') )
                                    <li class="{{ Request::is('roles/create')? 'active':'' }}">
                                        {{ HTML::link(URL::route('roles.create'), 'Nuevo Rol') }}
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->can('permissions:view'))
                        <li class="dropdown {{ Request::is('permissions*')? 'active':'' }}">
                            {{ HTML::link(URL::route('permissions.index'), 'Permisos', ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>'false']) }}
                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Request::is('permissions')? 'active':'' }}">
                                    {{ HTML::link(URL::route('permissions.index'), 'Lista de Permisos') }}
                                </li>
                                @if(Auth::user()->can('permissions:create'))
                                    <li class="{{ Request::is('permissions/create')? 'active':'' }}">
                                        {{ HTML::link(URL::route('permissions.create'), 'Nuevo Permiso') }}
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown {{ Request::is('user/*')? 'active':'' }}">
                        {{ HTML::link(URL::route('profile.user', Auth::user()->username), 'Perfil', ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>'false']) }}
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Request::is('user/*')? 'active':'' }}">
                                {{ HTML::link(URL::route('profile.user', Auth::user()->username), 'Mi Perfil') }}
                            </li>
                            @if(Auth::user()->can('users:changeownprofile'))
                                <li>
                                    {{ HTML::link(URL::route('account.update'), 'Actualizar Perfil') }}
                                </li>
                            @endif
                            <li class="{{ Request::is('account/change-password')? 'active':'' }}">
                                {{ HTML::link(URL::route('account.change.password'), 'Cambiar contraseña') }}
                            </li>
                            <li class="divider"></li>
                            <li>
                                {{ HTML::link(URL::route('account.sign-out'), 'Salir') }}
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="{{ Request::is('account/sing-in')? 'active':'' }}">
                        {{ HTML::link(URL::route('account.sign-in'), 'Entrar') }}
                    </li>
                    <li class="{{ Request::is('account/register')? 'active':'' }}">
                        {{ HTML::link(URL::route('account.register'), 'Registro') }}
                    </li>
                    <li class="{{ Request::is('account/forgot-password')? 'active':'' }}">
                        {{ HTML::link(URL::route('account.forgot.password'), 'Recuperar contraseña') }}
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>