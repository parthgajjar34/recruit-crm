<?php

/**
 * Laravel Trait
 * PHP version 8.1
 *
 * @category App\Traits
 * @package  App\Traits
 * @author   Parth Gajjar<parthgajjar34@gmail.com>
 */
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Trait Common
 *
 * @category App\Traits
 * @package  App\Traits
 * @author   Parth Gajjar<parthgajjar34@gmail.com>
 */

trait Common
{
    /**
     * Reusable method to output an error msg.
     * @param string | array $error
     * @param int $statusCode
     * @return JsonResponse
     */
    public function errorMsg($error, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        $error = [
            'success' => false,
            'error'   => $error,
        ];

        return response()->json($error, $statusCode);
    }

    /**
     * Reusable for success output to standardize it
     *
     * @param null $data
     * @return JsonResponse
     */
    public function successMsg($data = null): JsonResponse
    {
        $success = [
            'success' => true,
        ];

        $notEmptyCheck = !empty($data);
        if ($notEmptyCheck) {
            $success['data'] = $data;
        }

        return response()->json($success);
    }

}
