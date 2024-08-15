<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockIssueDetailResource;
use App\Models\StockIssueDetail;
use Illuminate\Http\Request;

class StockIssueDetailController extends Controller
{
    private $authUserCompany;

    public function __construct(){
        $this->authUserCompany = auth('api')->user()->company;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->id);
        return StockIssueDetailResource::collection($stockIssue->stockIssueDetails()->latest()->get());
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
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->stockIssue);

        $validated = $request->validate([
            'item_id' => 'required|uuid',
            'quantity' => 'required|numeric',
            'note' => '',
            'index' => '',
        ]);

        $validated['stock_issue_id'] = $stockIssue->id;

        $newStockIssueDetail = StockIssueDetail::create($validated);

        return response()->json([
            'message' => 'Create stock issue detail success',
            'stockIssueDetail' => $newStockIssueDetail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->stockIssue);
        $stockIssueDetail = $stockIssue->stockIssueDetails()->findOrFail($request->id);

        $validated = $request->validate([
            'item_id' => 'required|uuid',
            'quantity' => 'required|numeric',
            'note' => '',
            'index' => '',
        ]);

        $validated['stock_issue_id'] = $stockIssue->id;

        $stockIssueDetail->update($validated);

        return response()->json([
            'message' => 'Update stock issue detail success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $stockIssue = $this->authUserCompany->stockIssues()->findOrFail($request->stockIssue);
        $stockIssueDetail = $stockIssue->stockIssueDetails()->findOrFail($id);

        $stockIssueDetail->delete();

        return response()->json([
            'message' => 'Delete stock issue detail success',
        ]);
    }
}
