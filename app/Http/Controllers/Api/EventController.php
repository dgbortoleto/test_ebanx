<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    public function __construct(
        private TransactionService $transactionService,
        private AccountService $accountService
    ) {}

    public function store(Request $request)
    {
        return match ($request->input('type')) {
            'deposit' => response()->json(
                $this->transactionService->deposit(
                    $request->input('destination'),
                    $request->input('amount')
                ),
                Response::HTTP_CREATED
            ),
            'withdraw' => $this->handleWithdraw($request),
            'transfer' => $this->handleTransfer($request),
            default => response(null, Response::HTTP_BAD_REQUEST),
        };
    }

    private function handleWithdraw(Request $request)
    {
        $result = $this->transactionService->withdraw(
            $request->input('origin'),
            $request->input('amount')
        );

        return $result === 0
            ? response('0', Response::HTTP_NOT_FOUND)
            : response()->json($result, Response::HTTP_CREATED);
    }

    private function handleTransfer(Request $request)
    {
        $result = $this->transactionService->transfer(
            $request->input('origin'),
            $request->input('destination'),
            $request->input('amount')
        );

        return $result === 0
            ? response('0', Response::HTTP_NOT_FOUND)
            : response()->json($result, Response::HTTP_CREATED);
    }

    public function reset()
    {
        $this->accountService->reset();
        return response('', Response::HTTP_OK);
    }
}
