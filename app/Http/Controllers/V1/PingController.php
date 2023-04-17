<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PingController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'pong',
        ]);
    }
}
