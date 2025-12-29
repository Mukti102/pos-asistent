<?php

namespace App\Http\Controllers;

use App\Services\Assistant\AssistantService;
use App\Services\Assistant\IntentResolver;
use Illuminate\Http\Request;

class AsistentController extends Controller
{
    public function chat(Request $request)
    {   
        $request->validate([
            'message' => 'required|string'
        ]);

        $intent = app(IntentResolver::class)
                    ->resolve($request->message);

        $reply = app(AssistantService::class)
                    ->handle($intent);

        return response()->json([
            'reply' => $reply
        ]);
    }
}
