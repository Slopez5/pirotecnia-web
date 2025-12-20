<?php 

namespace App\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiRequest extends FormRequest {
    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->failure("message",400)
        );
    }
}