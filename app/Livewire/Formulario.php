<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Formulario extends Component
{
    // Valores ligados aos campos da view.
    public $name = '';
    public $email = '';
    public $password = '';

    // Define as regras que serão usadas na validação.
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', Password::min(8)],
        ];
    }

    // Mensagens personalizadas para os erros dos campos.
    protected function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome pode ter no máximo 100 caracteres.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Digite um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'Informe uma senha.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ];
    }

    // O Livewire chama este método depois que uma propriedade é atualizada.
    public function updated(string $property): void
    {
        // Valida somente o campo alterado, sem esperar o envio do formulário.
        $this->validateOnly($property);
    }

    // Executado quando a pessoa envia o formulário.
    public function save(): void
    {
        // Valida novamente todos os campos no servidor antes de salvar.
        $validated = $this->validate();

        // Cria o usuário e armazena a senha com hash, nunca em texto puro.
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Limpa os campos após o cadastro bem-sucedido.
        $this->reset(['name', 'email', 'password']);

        // Remove possíveis mensagens de erro antigas.
        $this->resetValidation();

        // A view usa esta mensagem para confirmar o cadastro.
        session()->flash('success', 'Cadastro realizado com sucesso!');
    }

    // Informa ao Livewire qual view renderizar.
    public function render()
    {
        return view('livewire.formulario');
    }
}

