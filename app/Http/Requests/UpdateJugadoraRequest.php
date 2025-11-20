<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJugadoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'dorsal' => 'required|integer|min:0',
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date|before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
            'foto' => 'nullable|file|mimes:png|max:2048',
        ];
    }
}