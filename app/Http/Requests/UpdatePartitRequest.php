<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'local_id'       => 'required|exists:equips,id|different:visitant_id',
            'visitant_id'    => 'required|exists:equips,id|different:local_id',
            'estadi_id'      => 'required|exists:estadis,id',
            'data'           => 'required|date',
            'jornada'        => 'required|integer|min:1',
            'gols_local'     => 'nullable|integer|min:0',
            'gols_visitant'  => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'local_id.different'    => 'El equip local i el visitant no poden ser el mateix.',
            'visitant_id.different' => 'El equip visitant i el local no poden ser el mateix.',
        ];
    }
}
