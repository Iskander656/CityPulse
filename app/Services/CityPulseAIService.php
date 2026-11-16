<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CityPulseAIService
{
    protected string $aiUrl = 'http://127.0.0.1:8000';

    public function classifyReport(string $description): array
    {
        $response = Http::timeout(10)
            ->post($this->aiUrl . '/predict', [
                'description' => $description,
            ]);

        if ($response->failed()) {
            throw new \Exception('CityPulse AI service is unavailable.');
        }

        return $response->json('prediction');
    }
}