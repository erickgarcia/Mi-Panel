<ul class="list-group">
    <li class="{{ Request::is('/')? 'active':'' }}">
        {{ HTML::link(URL::route('home'), 'Inicio') }}
    </li>
    @if(Auth::check())
        <li class="{{ Request::is('user/*')? 'active':'' }}">
            {{ HTML::link(URL::route('profile.user', Auth::user()->username), 'Perfil') }}
            <ul>
                <li class="{{ Request::is('account/change-password')? 'active':'' }}">
                    {{ HTML::link(URL::route('account.change.password'), 'Cambiar contraseña') }}
                </li>
            </ul>
        </li>
        @if(Auth::user()->can('users:view'))
        <li class="{{ Request::is('users*')? 'active':'' }}">
            {{ HTML::link(URL::route('users.index'), 'Usuarios') }}
            <ul>
                @if(Auth::user()->can('users:create'))
                <li class="{{ Request::is('users/create')? 'active':'' }}">
                    {{ HTML::link(URL::route('users.create'), 'Nuevo Usuario') }}
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::user()->can('roles:view'))
        <li class="{{ Request::is('roles*')? 'active':'' }}">
            {{ HTML::link(URL::route('roles.index'), 'Roles') }}
            <ul>
                @if(Auth::user()->can('roles:create') )
                <li class="{{ Request::is('roles/create')? 'active':'' }}">
                    {{ HTML::link(URL::route('roles.create'), 'Nuevo Rol') }}
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::user()->can('permissions:view'))
        <li class="{{ Request::is('permissions*')? 'active':'' }}">
            {{ HTML::link(URL::route('permissions.index'), 'Permisos') }}
            <ul>
                @if(Auth::user()->can('permissions:create'))
                <li class="{{ Request::is('permissions/create')? 'active':'' }}">
                    {{ HTML::link(URL::route('permissions.create'), 'Nuevo Permiso') }}
                </li>
                @endif
            </ul>
        </li>
        @endif
        <li>
            {{ HTML::link(URL::route('account.sign-out'), 'Salir') }}
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