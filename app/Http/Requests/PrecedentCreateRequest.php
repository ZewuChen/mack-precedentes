<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecedentCreateRequest extends FormRequest
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
        return [
            'number' => 'required',
            'body' => 'required',
            'court_id' => 'required|exists:courts,id',
            'type_id' => 'required|exists:precedent_types,id',
            'branch_id' => 'required|exists:branches,id',
            'segregated_at' => 'nullable|date',
            'approved_at' => 'nullable|date',
            'suspended_at' => 'nullable|date',
            'canceled_at' => 'nullable|date',
            'reviewed_at' => 'nullable|date',
            'pending_resources' => 'nullable',
            'additional_info' => 'nullable',
        ];
    }
}
