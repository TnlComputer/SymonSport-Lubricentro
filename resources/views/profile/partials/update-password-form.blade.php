<section class="card p-4 mb-4">
  <header class="mb-3">
    <h2 class="h5">{{ __('Actualizar Contraseña') }}</h2>
    <p class="text-muted small">
      {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerse segura.') }}
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
      <label for="update_password_current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
      <input id="update_password_current_password" name="current_password" type="password" class="form-control"
        autocomplete="current-password">
      <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger mt-1" />
    </div>

    <div class="mb-3">
      <label for="update_password_password" class="form-label">{{ __('Nueva Contraseña') }}</label>
      <input id="update_password_password" name="password" type="password" class="form-control"
        autocomplete="new-password">
      <x-input-error :messages="$errors->updatePassword->get('password')" class="text-danger mt-1" />
    </div>

    <div class="mb-3">
      <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
      <input id="update_password_password_confirmation" name="password_confirmation" type="password"
        class="form-control" autocomplete="new-password">
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-danger mt-1" />
    </div>

    <div class="d-flex align-items-center gap-3">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-key me-1"></i> {{ __('Guardar') }}
      </button>

      @if (session('status') === 'password-updated')
      <span class="text-success small" x-data="{ show: true }" x-show="show" x-transition
        x-init="setTimeout(() => show = false, 2000)">{{ __('Guardado.') }}</span>
      @endif
    </div>
  </form>
</section>