<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Verificación de Dos Pasos (2FA)</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            Hemos enviado un código de 6 dígitos a tu correo electrónico. 
                            Por favor, ingrésalo para continuar.
                        </p>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('2fa.verify') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código de Verificación</label>
                                <input type="text" name="codigo" id="codigo" 
                                       class="form-control form-control-lg text-center" 
                                       placeholder="000000" maxlength="6" required autofocus>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Verificar Código
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        El código expira en 5 minutos.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>