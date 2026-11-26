<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">

            {{-- Cartão para organizar o formulário. --}}
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    {{-- Título do formulário. --}}
                    <h1 class="h4 mb-4">Formulário</h1>

                    {{-- Confirmação exibida após o cadastro bem-sucedido. --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="status">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Envia o formulário ao método save() do componente Livewire. --}}
                    <form wire:submit="save" novalidate>

                        {{-- Campo de nome. --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>

                            {{-- Sincroniza o campo e valida após 300 ms sem digitação. --}}
                            <input
                                id="name"
                                type="text"
                                wire:model.live.debounce.300ms="name"
                                autocomplete="name"
                                class="form-control @error('name') is-invalid @enderror"
                                aria-describedby="name-error"
                            >

                            {{-- Mostra o erro de validação do nome. --}}
                            @error('name')
                                <div id="name-error" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Campo de e-mail. --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>

                            {{-- O Livewire valida o formato e se o e-mail já está cadastrado. --}}
                            <input
                                id="email"
                                type="email"
                                wire:model.live.debounce.300ms="email"
                                autocomplete="email"
                                class="form-control @error('email') is-invalid @enderror"
                                aria-describedby="email-error"
                            >

                            {{-- Mostra o erro de validação do e-mail. --}}
                            @error('email')
                                <div id="email-error" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Campo de senha. --}}
                        <div class="mb-4">
                            <label for="password" class="form-label">Senha</label>

                            {{-- Oculta os caracteres e sincroniza o valor com o componente. --}}
                            <input
                                id="password"
                                type="password"
                                wire:model.live.debounce.300ms="password"
                                autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror"
                                aria-describedby="password-error"
                            >

                            {{-- Mostra o erro de validação da senha. --}}
                            @error('password')
                                <div id="password-error" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Desativa o botão enquanto o método save está sendo executado. --}}
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                            wire:loading.attr="disabled"
                            wire:target="save"
                        >
                            {{-- Texto padrão do botão. --}}
                            <span wire:loading.remove wire:target="save">
                                Cadastrar
                            </span>

                            {{-- Indicador e texto exibidos durante o envio. --}}
                            <span wire:loading wire:target="save">
                                <span
                                    class="spinner-border spinner-border-sm me-2"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                Enviando...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>