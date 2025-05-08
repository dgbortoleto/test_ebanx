<?php

namespace App\Services;

class TransactionService
{
    public function __construct(private AccountService $accountService) {}

    public function deposit(string $accountId, int $amount): array
    {
        $balance = $this->accountService->get($accountId) ?? 0;
        $newBalance = $balance + $amount;
        $this->accountService->set($accountId, $newBalance);

        return [
            'destination' => [
                'id' => $accountId,
                'balance' => $newBalance
            ]
        ];
    }

    public function withdraw(string $accountId, int $amount): array|int
    {
        $balance = $this->accountService->get($origin);
        if ($balance === null) return 0;

        $newBalance = $balance - $amount;
        $this->accountService->set($origin, $newBalance);

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $newBalance
            ]
        ];
    }

    public function transfer(string $origin, string $accountId, int $amount): array|int
    {
        $originBalance = $this->accountService->get($origin);
        if ($originBalance === null) return 0;

        $accountIdBalance = $this->accountService->get($accountId) ?? 0;

        $this->accountService->set($origin, $originBalance - $amount);
        $this->accountService->set($accountId, $accountIdBalance + $amount);

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $originBalance - $amount
            ],
            'destination' => [
                'id' => $accountId,
                'balance' => $accountIdBalance + $amount
            ]
        ];
    }
}
