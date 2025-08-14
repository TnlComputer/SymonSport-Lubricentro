<section class="card p-4 mb-4">
  <header class="mb-3">
    <h2 class="h5">{{ __('Eliminar Cuenta') }}</h2>
    <p class="text-muted small">
      {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados de forma permanente. Antes de eliminar tu cuenta, descarga cualquier información o dato que quieras conservar.') }}
    </p>
  </header>

  <!-- Botón de abrir modal -->
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
    <i class="fas fa-trash-alt me-1"></i> {{ __('Eliminar Cuenta') }}
  </button>

  <!-- Modal -->
  <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="{{ route('profile.destroy') }}">
          @csrf
          @method('delete')

          <div class="modal-header">
            <h5 class="modal-title" id="confirmUserDeletionLabel">
              {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <p class="text-muted small">
              {{ __('Una vez eliminada, tu cuenta y todos sus datos serán borrados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminarla.') }}
            </p>

            <div class="mb-3">
              <input id="password" name="password" type="password" class="form-control"
                placeholder="{{ __('Contraseña') }}">
              <x-input-error :messages="$errors->userDeletion->get('password')" class="text-danger mt-1" />
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
            <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>