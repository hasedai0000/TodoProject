<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'id' => ['required', 'integer', 'exists:todos,id'],
      'title' => ['required', 'string'],
      'content' => ['required', 'string'],
      'is_completed' => ['required', 'boolean'],
    ];
  }
}
