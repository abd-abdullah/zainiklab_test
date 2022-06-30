<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $transactions = new Transaction();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = [];
            $orderBy = ['order' => 'ASC'];

            if ($request->input('length')) {
                $limit = $request->input('length');
            }

            if ($request->input('order')[0]['column'] != 0) {
                $column_name = $request->input('columns')[$request->input('order')[0]['column']]['name'];
                $sort = $request->input('order')[0]['dir'];
                $orderBy[$column_name] = $sort;
            }

            if ($request->input('start')) {
                $offset = $request->input('start');
            }

            if ($request->input('search') && $request->input('search')['value'] != "") {
                $search['transaction_id'] = $request->input('search')['value'];
                $search['payment_method'] = $request->input('search')['value'];
                $search['status'] = $request->input('search')['value'];
            }

            if ($request->input('where')) {
                $where = $request->input('where');
            }

            $with = [
                'student',
                'course',
            ];

            $transactions = $transactions->getDataForDataTable($limit, $offset, $search, $where, $with);
            return response()->json($transactions);
        }

        return view('transactions.index', ['page_slug' => 'transaction']);
    }
}
