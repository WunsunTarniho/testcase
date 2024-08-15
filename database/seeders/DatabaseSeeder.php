<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountGroup;
use App\Models\Company;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\Product;
use App\Models\Status;
use App\Models\StockIssue;
use App\Models\StockIssueDetail;
use App\Models\UnitItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $newUser = User::factory()->create([
            'username' => 'testcase',
            'password' => 'testcase123',
        ]);

        $newCompany = Company::factory()->create([
            'user_id' => $newUser->id,
            'company_name' => 'TestCase',
        ]);

        $newItemGroup = ItemGroup::factory()->create([
            // 'company_id' => $newCompany->id,
            'group_name' => 'Lain - lain',
        ]);

        $newAccountGroup = AccountGroup::factory()->create([
            // 'company_id' => $newCompany->id,
            'account_group_name' => "Default - Account",
        ]);

        $newUnitItem = UnitItem::factory()->create([
            'unit_name' => 'PCS',
        ]);

        $newProduct = Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);
        $newProduct = Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);
        
        Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);
        
        Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);
     
        Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);
        Item::factory()->create([
            'company_id' => $newCompany->id,
            'item_name' => 'Product Test',
            // 'code' => '384914',
            // 'price' => 2000,
            'item_group_id' => $newItemGroup->id,
            'account_group_id' => $newAccountGroup->id,
            'unit_id' => $newUnitItem->id,
            'is_active' => true,
        ]);

        $newEntry = Status::factory()->create([
            'status_name' => 'Entry',
        ]);

        $newPosted = Status::factory()->create([
            'status_name' => 'Posted',
        ]);

        $newCompleted = Status::factory()->create([
            'status_name' => 'Completed',
        ]);

        $newAccount = Account::factory()->create([
            // 'company_id' => $newCompany->id,
            'account_name' => "Biaya Admin Bank - 870-001",
        ]);

        $newStockIssue = StockIssue::factory()->create([
            'company_id' => $newCompany->id,
            'code' => '274912',
            'account_id' => $newAccount->id,
            'note' => 'Contoh Keterangan',
            // 'status_id' => $newEntry->id,
        ]);

        StockIssueDetail::factory()->create([
            'stock_issue_id' => $newStockIssue->id,
            'item_id' => $newProduct->id,
            'quantity' => 10,
            'note' => 'Contoh Keterangan',
            'index' => null,
        ]);
    }
}
