<?php

namespace App\Http\Livewire;

use App\Mail\PasswordUpdateMail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ResetPasswordForm extends Component
{
    public $token;
    public $password;
    public $password_confirmation;

    public $showSuccessModal;

    public function mount($token){
        $this->token   =   $token;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
    }

    public function setPassword(){
        $this->validate([
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $token = PasswordReset::where('token', $this->token)->first();
        if (!$token){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Invalid token']);
        }
        $tokenDate = Carbon::parse($token->expires_at);
        // Check if it has not expired
        if ($tokenDate <= Carbon::now()){
            // Delete the token and send response to user
            $token->delete();
            return $this->emit('alert', ['type' => 'error', 'message' => 'Invalid token']);
        }

        // Update user password
        $user = User::where('email', $token->email)->first();
        $user->password = $this->password;
        $user->save();

        // Delete token
        $token->delete();

        // Mail the user concerning the update
        Mail::to($user->email)->send(new PasswordUpdateMail($user));

        $this->showSuccessModal = true;
        return $this->emit('alert', ['type' => 'success', 'message' => 'Password reset successfully']);

    }

    public function render()
    {
        return view('livewire.auth.components.reset-password-form');
    }
}
