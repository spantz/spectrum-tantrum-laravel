<?php

namespace App\Http\Requests;

use App\Models\Data\AggregateConstants;
use App\Models\Test;
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
            'duration' => 'integer',
            'durationUnit' => 'valid_unit',
            'roundDuration' => 'integer',
            'roundDurationUnit' => 'valid_unit'
        ];
    }

    public function getDuration(): int
    {
        return $this->get('duration', 7);
    }

    public function getDurationUnit(): string
    {
        return $this->get('durationUnit', AggregateConstants::DURATION_DAYS);
    }

    public function getRoundDuration(): int
    {
        return $this->get('roundDuration', 6);
    }

    public function getRoundDurationUnit(): string
    {
        return $this->get('roundDurationUnit', AggregateConstants::DURATION_HOURS);
    }

}