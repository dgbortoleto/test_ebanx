<?php

namespace App\Repositories\InMemory;

use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class InMemoryAccountRepository implements AccountRepositoryInterface
{
    protected string $cacheKey = 'accounts';

    public function get(string $accountId): ?int
    {
        return $this->all()[$accountId] ?? null;
    }

    public function set(string $accountId, int $balance): void
    {
        $accounts = $this->all();
        $accounts[$accountId] = $balance;
        Cache::forever($this->cacheKey, $accounts);
    }

    public function reset(): void
    {
        Cache::forget($this->cacheKey);
    }

    private function all(): array
    {
        return Cache::get($this->cacheKey, []);
    }
}
