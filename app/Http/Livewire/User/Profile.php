<?php

namespace App\Http\Livewire\User;

use DateTime;
use Exception;
use App\Models\User;
use App\Models\Perfil;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;
    public $profile;

    public $name;
    public $email;
    public $maritalStatus;
    public $phone;
    public $date;
    public $photo;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'maritalStatus' => 'required',
        'phone' => 'nullable',
        'date' => 'required',
        'photo' => 'nullable|mimes:jpg,jpeg,png',
    ];

    protected $messages = [
        'name.required' => 'Campo obrigatório',
        'email.required' => 'Campo obrigatório',
        'maritalStatus.required' => 'Campo obrigatório',
        'date.required' => 'Campo obrigatório',
        'photo.mimes' => 'A foto precisa ser de um formato válido (jpg,jpeg,png)',
    ];

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->profile = Perfil::find($user->perfil_id)->perfil;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->maritalStatus = $user->estado_civil;
        $this->phone = $user->telefone;
        $this->date = $user->data_nascimento;
    }
    public function render()
    {
        return view('livewire.user.profile');
    }

    public function update()
    {
        $this->validate();
        try {
            if ($this->photo) {
                $today = new DateTime('now');

                $nameFile = hash('sha1', $this->photo->getClientOriginalName() . $today->format('u'));
            }


            $user = User::find(Auth::user()->id);

            $user->name = $this->name;
            $user->email = $this->email;
            $user->estado_civil = $this->maritalStatus;
            $user->data_nascimento = $this->date;
            $user->telefone = $this->phone;
            $user->path_photo = $this->photo ? 'storage/' . $this->photo->storeAs('users', $nameFile  .  '.' . $this->photo->getClientOriginalExtension()) : $user->path_photo;

            $user->save();

            toastr()->addSuccess('Perfil atualizado com sucesso', 'Feito!');
        } catch (Exception $e) {
            toastr()->addError('Não foi posível atualizar', 'Erro!');
        }
    }
}
