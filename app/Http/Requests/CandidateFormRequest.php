<?php

namespace App\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Class CandidateFormRequest
 *
 * @category App\Requests
 * @package  Aspire mini app
 * @author   Parth Gajjar<parthgajjar34@gmail.com>
 */

class CandidateFormRequest extends FormRequest
{
    use Common;

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
            'first_name'    => 'required',
            'last_name'     => 'max:40',            
            'email'         => 'email|unique:candidates,email|max:100',
            'contact_number'=> 'max:100',
            'specialization'=> 'max:200',
            'work_ex_year'  => 'max:30',
            'candidate_dob' => 'max:40',
            'address'       => 'max:40',
            'resume'        => 'mimes:csv,txt,xlx,xls,pdf|max:2048'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            $this->errorMsg($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}