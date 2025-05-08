<?php

namespace App\Services;

use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        private AccountRepositoryInterface $repo
    ) {}

    public function reset(): void
    {
        $this->repo->reset();
    }

    public function get(string $accountId): ?int
    {
        return $this->repo->get($accountId);
    }

    public function set(string $accountId, int $balance): void
    {
        $this->repo->set($accountId, $balance);
    }
}
