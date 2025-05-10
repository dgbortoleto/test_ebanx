<?php

namespace App\Services;

class TransactionService
{
    public function __construct(private AccountService $accountService) {}

    public function deposit(string $destination, int $amount): array
    {
        $balance = $this->accountService->get($destination) ?? 0;
        $newBalance = $balance + $amount;
        $this->accountService->set($destination, $newBalance);

        return [
            'destination' => [
                'id' => $destination,
                'balance' => $newBalance
            ]
        ];
    }

    public function withdraw(string $origin, int $amount): array|int
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

    public function transfer(string $origin, string $destination, int $amount): array|int
    {
        $originBalance = $this->accountService->get($origin);
        if ($originBalance === null) return 0;

        $destinationBalance = $this->accountService->get($destination) ?? 0;

        $this->accountService->set($origin, $originBalance - $amount);
        $this->accountService->set($destination, $destinationBalance + $amount);

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $originBalance - $amount
            ],
            'destination' => [
                'id' => $destination,
                'balance' => $destinationBalance + $amount
            ]
        ];
    }
}
