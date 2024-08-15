<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountGroup;
use App\Models\ItemGroup;
use App\Models\Status;
use App\Models\UnitItem;
use Illuminate\Http\Request;

class SelectItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    private $authUserCompany;

    public function __construct(){
        $this->authUserCompany = auth('api')->user()->company;
    }

    public function __invoke(Request $request)
    {
        $accounts = Account::where('company_id', $this->authUserCompany->id)->orWhereNull('company_id')->get();
        $item_groups = ItemGroup::where('company_id', $this->authUserCompany->id)->orWhereNull('company_id')->get();
        $account_groups = AccountGroup::where('company_id', $this->authUserCompany->id)->orWhereNull('company_id')->get();
        $unit_items = UnitItem::all();
        $statues = Status::all();

        return response()->json([
            'accounts' => $accounts,
            'account_groups' => $account_groups,
            'unit_items' => $unit_items,
            'item_groups' => $item_groups,
            'statues' => $statues,
        ]);
    }
}
