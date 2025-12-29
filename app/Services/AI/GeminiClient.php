<?php

use Illuminate\Support\Facades\Http;

class GeminiClient
{
    public function ask(string $prompt)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            config('services.gemini.url'),
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

        return $response
            ->json()['candidates'][0]['content']['parts'][0]['text'];
    }
}
