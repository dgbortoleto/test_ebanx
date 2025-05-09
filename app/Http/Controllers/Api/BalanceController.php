<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BalanceController extends Controller
{
    public function __construct(private AccountService $accountService) {}

    public function index(Request $request)
    {
        $accountId = $request->query('account_id');
        $balance = $this->accountService->get($accountId);

        return $balance === null
            ? response('0', Response::HTTP_NOT_FOUND)
            : response($balance, Response::HTTP_OK);
    }
}
