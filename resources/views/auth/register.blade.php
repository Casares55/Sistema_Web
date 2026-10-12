<x-guest-layout>
    @section('styles')
        <!-- Custom fonts for this template-->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @endsection

    <body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">¡Crear una Cuenta!</h1>
                            </div>

                            <!-- Mensaje de sesión -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('register') }}" class="user">
                                @csrf

                                <!-- Nombre -->
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                               id="nombre" name="nombre"
                                               value="{{ old('nombre') }}"
                                               required autofocus
                                               placeholder="Nombre(s)">
                                        <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-danger small" />
                                    </div>
                                </div>

                                <!-- Apellido Paterno y Materno -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                               id="ap" name="ap"
                                               value="{{ old('ap') }}"
                                               required
                                               placeholder="Apellido Paterno">
                                        <x-input-error :messages="$errors->get('ap')" class="mt-2 text-danger small" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user"
                                               id="am" name="am"
                                               value="{{ old('am') }}"
                                               placeholder="Apellido Materno">
                                        <x-input-error :messages="$errors->get('am')" class="mt-2 text-danger small" />
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                           id="email" name="email"
                                           value="{{ old('email') }}"
                                           required
                                           placeholder="Correo electrónico">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                                </div>

                                <!-- Rol -->
                                <div class="form-group">
                                    <select name="rol_id" id="rol_id" class="form-control form-control-user" required>
                                        <option value="">Seleccione un rol</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id_rol }}" {{ old('rol_id') == $rol->id_rol ? 'selected' : '' }}>
                                                {{ $rol->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('rol_id')" class="mt-2 text-danger small" />
                                </div>

                                <!-- Contraseña y confirmación -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                               id="password" name="password"
                                               required
                                               placeholder="Contraseña">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                               id="password_confirmation" name="password_confirmation"
                                               required
                                               placeholder="Repetir contraseña">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger small" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Registrar Cuenta
                                </button>

                                <hr>
                            </form>

                            <hr>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">
                                    ¿Ya tienes una cuenta? ¡Inicia sesión!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @endsection
    </body>
</x-guest-layout>
