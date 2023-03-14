<?php

namespace App\Http\Livewire\User;

use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $classes;
    public $name;
    public $email;
    public $maritalStatus;
    public $class_id;
    public $birthDate;
    public $phone;
    public $profiles;
    public $perfil;


    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'maritalStatus' => 'required',
        'class_id' => 'required',
        'birthDate' => 'required',
        'phone' => 'nullable|min:9'
    ];

    protected $messages = [
        'name.required' => 'O campo Nome é obrigatório.',
        'email.required' => 'O campo Email é obrigatório.',
        'email.email' => 'O campo Email precisa ter um formato válido.',
        'class_id.required' => 'O campo Turma é obrigatório.',
        'birthDate.required' => 'O campo Data de nascimento é obrigatório',
        'phone.min' => 'O campo Telefone precisa ter pelo menos 9 caracteres.'
    ];

    public function mount()
    {
        $this->classes = Turma::where('igreja_id', User::getIgreja()->id)->get();
        $this->profiles = Perfil::all();
    }
    public function render()
    {
        return view('livewire.user.register');
    }

    public function store()
    {
        $this->validate();
        try {
            User::storeUser(
                $this->name,
                $this->email,
                $this->perfil,
                $this->maritalStatus,
                $this->birthDate,
                $this->class_id,
                null,
                $this->phone,
                User::getIgreja()->id
            );

            toastr()->addSuccess('Usuário cadastrado', 'Sucesso');
        } catch (Exception $e) {
            toastr()->addError('Não foi possível cadastrar', 'Erro');
        }
    }
}
