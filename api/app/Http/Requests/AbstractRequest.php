<?php


namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AbstractRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
                                         'data'   => [],
                                         'errors' => $validator->errors(),
                                         'message' => trans('exceptions.default_request_error')
                                     ], Response::HTTP_BAD_REQUEST);

        throw new ValidationException($validator, $response);
    }
}