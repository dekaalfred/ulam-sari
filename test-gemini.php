
<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(
    \Illuminate\Contracts\Console\Kernel::class
)->bootstrap();

$key = config('services.gemini.api_key');

if (!$key) {
    exit("ERROR: API KEY KOSONG\n");
}

try {
    $response = \Illuminate\Support\Facades\Http::timeout(30)
        ->withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $key,
        ])
        ->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'Balas dengan kata BERHASIL']
                        ]
                    ]
                ]
            ]
        );

    echo "HTTP STATUS: " . $response->status() . PHP_EOL;

    $body = $response->json();

    if (isset($body['error'])) {
        echo "ERROR: " . ($body['error']['message'] ?? 'Tidak diketahui') . PHP_EOL;
    } else {
        echo "RESPONSE: " . json_encode(
            $body,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        ) . PHP_EOL;
    }

} catch (\Throwable $e) {
    echo "EXCEPTION: " . $e->getMessage() . PHP_EOL;
}