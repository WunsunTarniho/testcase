<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Error;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $authUserCompany;

    public function __construct()
    {
        $this->authUserCompany = auth('api')->user()->company;
    }

    public function index()
    {
        $items = $this->authUserCompany->items()->latest()->get();

        return response()->json([
            'message' => 'Get all item success',
            'data' => ItemResource::collection($items),
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
            'item_name' => 'required|string',
            'code' => 'unique:items',
            'item_group_id' => 'required|uuid',
            'account_group_id' => 'required|uuid',
            'unit_id' => 'required|uuid',
            'is_active' => 'required',
        ]);

        $validated['company_id'] = $this->authUserCompany->id;

        $newItem = Item::create($validated);

        return response()->json([
            'message' => 'Create item success',
            'item' => $newItem,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->authUserCompany->items()->findOrFail($id);
        return response()->json($item);
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
            'item_name' => 'required|string',
            'item_group_id' => 'required|uuid',
            'account_group_id' => 'required|uuid',
            'unit_id' => 'required|uuid',
            'is_active' => 'required',
        ];

        $item = $this->authUserCompany->items()->findOrFail($request->id);

        if ($item['code'] != $request->input('code')) {
            $rules['code'] = "unique:items";
        }

        $validated = $request->validate($rules);

        $validated['company_id'] = $this->authUserCompany->id;

        $item->update($validated);

        return response()->json([
            'message' => 'Update item success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $item = $this->authUserCompany->items()->findOrFail($request->id);

        $item->delete();

        return response()->json([
            'message' => 'Delete item success',
        ]);
    }
}
