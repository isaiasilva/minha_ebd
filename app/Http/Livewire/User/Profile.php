<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Perfil;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

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
        $user = User::find(Auth::user()->id);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->estado_civil = $this->maritalStatus;
        $user->data_nascimento = $this->date;
        $user->telefone = $this->phone;
        $user->path_photo = $this->photo ? 'storage/' . $this->photo->storeAs('users', Str::slug($user->name) . '.' . $this->photo->getClientOriginalExtension()) : $user->path_photo;

        $user->save();

        toastr()->addSuccess('Perfil atualizado com sucesso', 'Feito!');
    }
}
