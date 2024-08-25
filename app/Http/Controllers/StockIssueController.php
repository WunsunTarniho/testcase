<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockIssueResource;
use App\Http\Resources\StockIssueShowResource;
use App\Models\StockIssue;
use App\Models\StockIssueDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockIssueController extends Controller
{

    private $authUserCompany;

    public function __construct(){
        $this->authUserCompany = auth('api')->user()->company;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Get all item success',
            'data' => StockIssueResource::collection($this->authUserCompany->stockIssues()->latest()->get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'unique:stock_issues',
            'account_id' => 'required|uuid',
            'note' => '',
            'created_at' => 'required|date|date_format:Y-m-d',
        ], [
            'account_id' => 'Choose one account'
        ]);

        $validated['company_id'] = $this->authUserCompany->id;

        $newStockIssue = StockIssue::create($validated);

        return response()->json([
            'message' => 'Create stock issue success',
            'stockIssue' => $newStockIssue,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($id);

        return response()->json(StockIssueShowResource::make($stockIssue));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rules = [
            'account_id' => 'required|uuid',
            'note' => '',
            'created_at' => 'required|date|date_format:Y-m-d',
        ];

        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->id);

        if ($stockIssue['code'] != $request->input('code')) {
            $rules['code'] = "unique:stock_issues";
        }

        $validated = $request->validate($rules);

        $validated['company_id'] = $this->authUserCompany->id;

        $stockIssue->update($validated);

        return response()->json([
            'message' => 'Update stock issue success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->id);

        StockIssueDetail::where('stock_issue_id', $request->id)->delete();
        $stockIssue->delete();

        return response()->json([
            'message' => 'Delete stock issue success',
        ]);
    }
}
