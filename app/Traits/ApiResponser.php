<?php

namespace App\Traits; 

use \Illuminate\Http\JsonResponse; 

trait ApiResponser 
{

    /**
     * Resource was successfully created
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createdResponse($data)
    {
        $response = $this->successEnvelope(201, $data, 'Created');
        return response()->json($response, 201);
    }

    /**
     * Resource was successfully updated
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updatedResponse($data)
    {
        $response = $this->successEnvelope(200, $data, 'Updated');
        return response()->json($response, 200);
    }

    /**
     * Resource was failure updated
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notUpdatedResponse($message)
    {
        $response = $this->errorEnvelope(204, [], $message);
        return response()->json($response, 204);
    }
    
    /**
     * Resource was successfully deleted
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deletedResponse()
    {
        $response = $this->successEnvelope(200, [], 'Deleted');
        return response()->json($response, 200);
    }
    /**
     * Returns general error
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($errors)
    {
        $response = $this->errorEnvelope(400, $errors);
        return response()->json($response, 400);
    }

    /**
     * Returns unauthenticated error
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthenticatedResponse($message)
    {
        $response = $this->errorEnvelope(401, $message);
        return response()->json($response, 401);
    }

    /**
     * Client does not have proper permissions to perform action.
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function insufficientPrivilegesResponse($message)
    {
        $response = $this->errorEnvelope(403, $message,
            'Forbidden');
        return response()->json($response, 403);
    }
    /**
     * Returns a list of resources
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function listResponse($data)
    {
        $response = $this->successEnvelope(200, $data);
        return response()->json($response);
    }
    /**
     * Requested resource wasn't found
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFoundResponse($message)
    {
        $response = $this->errorEnvelope(404, [], $message);
        return response()->json($response, 404);
    }

    /**
     * Requested mothods is not allowed
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notAllowedHttpResponse($message)
    {
        $response = $this->errorEnvelope(405, [], $message);
        return response()->json($response, 405);
    }

    /**
     * Query methods is not acceptable
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notAcceptQueryResponse($message, $err = [])
    {
        $response = $this->errorEnvelope(409, $err, $message);
        return response()->json($response, 409);
    }

    /**
     * Unexpected Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unexpectedExceptionResponse($message, $err)
    {
        $response = $this->errorEnvelope(500, $err, $message);
        return response()->json($response, 500);
    }

    /**
     * Return information for single resource
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showResponse($data)
    {
        $response = $this->successEnvelope(200, $data);
        return response()->json($response);
    }
    /**
     * Return error when request is properly formatted, but contains validation errors
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validationErrorResponse($errors)
    {
        $response = $this->errorEnvelope(422, $errors, 'Unprocessable Entity');
        return response()->json($response, 422);
    }
    /**
     * Standard error envelope structure
     *
     * @param int $status
     * @param array $errors
     * @param string $message
     * @return array
     */
    private function errorEnvelope(
        $status = 400,
        $errors = [],
        $message = 'Bad Request'
    ) {
        return [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ];
    }
    /**
     * Standard success envelope structure
     *
     * @param int $status
     * @param array $data
     * @param string $message
     * @return array
     */
    private function successEnvelope(
        $status = 200,
        $data = [],
        $message = 'OK'
    ) {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }
    
}