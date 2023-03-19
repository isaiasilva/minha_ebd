<?php

namespace App\Http\Livewire\User;

use DateTime;
use Exception;
use App\Models\User;
use App\Models\Perfil;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $user_id;
    public $profile;
    public $profiles;
    public $name;
    public $email;
    public $maritalStatus;
    public $phone;
    public $date;
    public $path_photo;
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
        $this->profiles = Perfil::where('id', '!=', Perfil::ADMINISTRADOR)->get();
        if (auth()->user()->perfil_id == Perfil::ADMINISTRADOR) {
            $this->profiles = Perfil::all();
        }

        $user = User::find(request('id'));
        $this->user_id = $user->id;
        $this->profile = $user->perfil_id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->maritalStatus = $user->estado_civil;
        $this->path_photo = $user->path_photo;
        $this->phone = $user->telefone;
        $this->date = $user->data_nascimento;
    }

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function update()
    {
        $this->validate();
        try {
            $user = User::find($this->user_id);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->estado_civil = $this->maritalStatus;
            $user->perfil_id = $this->profile;
            $user->data_nascimento = $this->date;
            $user->telefone = $this->phone;
            $user->path_photo = $this->photo ?  $this->updatePhoto($user->path_photo) : $user->path_photo;

            $user->save();

            toastr()->addSuccess('Usuário atualizado com sucesso', 'Feito!');
            return redirect(route('user.edit', ['id' => $user->id]));
        } catch (Exception $e) {
            toastr()->addError('Não foi posível atualizar', 'Erro!');
        }
    }

    protected function updatePhoto(string $path_photo): string
    {
        if ($path_photo != "img/profile/user-512.webp") {
            Storage::delete($path_photo);
        }

        $today = new DateTime('now');

        $nameFile = hash('sha1', $this->photo->getClientOriginalName() . $today->format('u'));

        return 'storage/' . $this->photo->storeAs('users', $nameFile  .  '.' . $this->photo->getClientOriginalExtension());
    }
}
