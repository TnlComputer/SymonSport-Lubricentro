<section>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user"></i> Información de Perfil</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-4">
                Actualiza la información de tu cuenta y tu dirección de correo electrónico.
            </p>

            <!-- Formulario oculto para enviar verificación -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <!-- Formulario de actualización -->
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" name="name" type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $user->nombre) }}" required autofocus autocomplete="name">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="mt-3">
                            <div class="alert alert-warning p-2 mb-2">
                                <i class="fas fa-exclamation-circle"></i> Tu correo electrónico no está verificado.
                                <button form="send-verification" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fas fa-envelope"></i> Reenviar verificación
                                </button>
                            </div>
                            @if (session('status') === 'verification-link-sent')
                                <div class="alert alert-success p-2 mt-2 mb-0">
                                    <i class="fas fa-check-circle"></i> Se ha enviado un nuevo enlace de verificación a
                                    tu correo electrónico.
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success ms-2">Guardado.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
