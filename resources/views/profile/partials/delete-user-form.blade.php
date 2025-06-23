<section>
    <header>
        <h4>
            {{ __('Delete Account') }}
        </h4>

        <p class="text-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Tombol ini akan memicu modal Bootstrap --}}
    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        {{ __('Delete Account') }}
    </button>
    
    @push('scripts')
    {{-- Modal untuk Konfirmasi Penghapusan --}}
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">{{ __('Are you sure you want to delete your account?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p>
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-3">
                            <label for="password_delete" class="form-label visually-hidden">{{ __('Password') }}</label>
                            <input
                                id="password_delete"
                                name="password"
                                type="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror" {{-- Menambahkan kelas is-invalid jika ada error --}}
                                placeholder="{{ __('Password') }}"
                            />
                            {{-- Menampilkan pesan error validasi --}}
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">{{ __('Delete Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah ada error validasi khusus dari 'userDeletion' error bag
        // dan jika modal belum terbuka, maka buka modal
        @if ($errors->userDeletion->isNotEmpty())
            var confirmUserDeletionModal = new bootstrap.Modal(document.getElementById('confirm-user-deletion'));
            confirmUserDeletionModal.show();
        @endif

        // Opsional: Bersihkan input password saat modal ditutup
        var modalElement = document.getElementById('confirm-user-deletion');
        if (modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function () {
                var passwordInput = document.getElementById('password_delete');
                if (passwordInput) {
                    passwordInput.value = ''; // Bersihkan input password
                    // Juga hapus kelas validasi dan pesan error
                    passwordInput.classList.remove('is-invalid');
                    var errorDiv = passwordInput.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('text-danger')) {
                        errorDiv.textContent = ''; // Kosongkan pesan error
                    }
                }
            });
        }
    });
</script>
@endpush