<?php
namespace App\Repositories\Interfaces;

interface AccountRepositoryInterface
{
    public function get(string $accountId): ?int;
    public function set(string $accountId, int $balance): void;
    public function reset(): void;
}