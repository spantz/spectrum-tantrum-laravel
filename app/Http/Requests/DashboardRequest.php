<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer duration
 * @property string unit
 */
class DashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'duration' => 'required|integer',
            'unit' => 'required|valid_unit'
        ];
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}