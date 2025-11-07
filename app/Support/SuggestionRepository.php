<?php

namespace App\Support;

class SuggestionRepository
{
    private const FILE_PATH = __DIR__ . '/../../storage/data/submissions.json';

    private const CATEGORIES = [
        'salary' => 'Цалин урамшуулал',
        'hr_development' => 'Хүний нөөцийн сургалт хөгжил',
        'digital_health' => 'Цахим ба Эрүүл мэндийн өгөгдөл',
        'insurance' => 'Эрүүл мэндийн даатгал',
        'public_health' => 'Нийгмийн эрүүл мэнд',
    ];

    public static function categories(): array
    {
        return self::CATEGORIES;
    }

    public static function all(): array
    {
        if (!file_exists(self::FILE_PATH)) {
            return [];
        }

        $json = file_get_contents(self::FILE_PATH);
        $data = json_decode($json, true);

        return is_array($data) ? $data : [];
    }

    public static function store(array $entry): void
    {
        $data = self::all();
        $data[] = $entry;
        file_put_contents(self::FILE_PATH, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public static function counts(): array
    {
        $counts = array_fill_keys(array_keys(self::CATEGORIES), 0);
        foreach (self::all() as $entry) {
            $key = $entry['category'] ?? null;
            if ($key && array_key_exists($key, $counts)) {
                $counts[$key]++;
            }
        }

        return $counts;
    }
}
