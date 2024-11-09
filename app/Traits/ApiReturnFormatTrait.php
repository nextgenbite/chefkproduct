<?php

namespace App\Traits;
use Illuminate\Support\Facades\Validator;

trait ApiReturnFormatTrait {

    // Flash a message to the session
    protected function setMessage(string $message = '', string $type = 'success'): void
    {
        session()->flash('message', $message);
        session()->flash('type', $type);
    }

    // Validate data and return JSON response on failure
    protected function validateWithJson(array $data = [], array $rules = []): \Illuminate\Http\JsonResponse|bool
    {
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Return a success response with optional data
    protected function responseWithSuccess(string $message = '', array $data = [], int $code = 200): \Illuminate\Http\JsonResponse
    {
        return $this->jsonResponse(true, $message, $data, $code);
    }

    // Return a not found response
    protected function responseWithNotFound(string $message = '', int $code = 404): \Illuminate\Http\JsonResponse
    {
        return $this->jsonResponse(false, $message, [], $code);
    }

    // Return an error response with optional data
    protected function responseWithError(string $message = '', array $data = [], int $code = 400): \Illuminate\Http\JsonResponse
    {
        return $this->jsonResponse(false, $message, $data, $code);
    }

    // Helper method to standardize JSON response format
    private function jsonResponse(bool $success, string $message, array $data = [], int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(compact('success', 'message', 'data'), $code);
    }

 
}

