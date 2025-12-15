<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return 
        [
            'nombre' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\p{Han}\p{Hiragana}\p{Katakana}\x{30FB}\x{30FC}\.\s]+$/u'],
            'correo_electronico' => ['required', 'min:5', 'max:150', 'email:rfc,dns'],
            'telefono' => ['required', 'size:10', 'regex:/^[0-9]+$/'],
            'acepta' => ['required', 'accepted'],
            'portales_cautivos_id' => ['required'],
        ];
    }

    public function messages()
    {
        return 
        [
            // mensajes para "nombre"
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener mayúsculas, minúsculas, puntos, acentos en vocales y caracteres del idioma japonés y chino',

            // mensajes para "correo_electronico"
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.min' => 'El correo electrónico debe tener al menos 5 caracteres.',
            'correo_electronico.max' => 'El correo electrónico no puede exceder 150 caracteres.',
            'correo_electronico.email' => 'El correo electrónico debe ser una dirección válida (formato RFC).',

            // mensajes para "telefono"
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.size' => 'El télefono debe ser de 10 digitos sin espacios',
            'telefono.regex' => 'El teléfono solo puede contener números del 0 al 9',

            // Mensajes para el nuevo campo 'acepta' (checkbox)
            'acepta.required' => 'Debe aceptar las condiciones de servicio para continuar.',
            'acepta.accepted' => 'Debe aceptar las condiciones de servicio para continuar.'
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
