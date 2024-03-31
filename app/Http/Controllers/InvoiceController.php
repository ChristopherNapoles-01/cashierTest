<?php

namespace App\Http\Controllers;

use App\Http\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(
        private InvoiceService $invoiceService
    ){}

    public function index(Request $request)
    {
        $data = $this->invoiceService->listInvoices($request->all());

        return response()->json(
            [
                'data' => $data
            ]
        );
    }

    public function getUpcomingInvoice(Request $request)
    {
        $data = $this->invoiceService->upcomingInvoices($request->all());

        return response()->json(
            [
                'data' => $data
            ]
        );
    }

    public function show()
    {

    }
}
