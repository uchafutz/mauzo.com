<?php

namespace Database\Seeders;

use App\Models\Config\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UNITS PERMISSIONS
        Permission::firstOrCreate([
            'name' => "ACCESS_UNIT",
            'display' => "Access Unit",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_UNIT",
            'display' => "Create Unit",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_UNIT",
            'display' => "Update Unit",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_UNIT",
            'display' => "Delete Unit",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_UNIT",
            'display' => "Retrieve Unit",
        ]);


        //PERMISSION ROLES

        Permission::firstOrCreate([
            'name' => "ACCESS_ROLE",
            'display' => "Access Role",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_ROLE",
            'display' => "Create Role",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_ROLE",
            'display' => "Update Role",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_ROLE",
            'display' => "Delete Role",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_ROLE",
            'display' => "Retrieve Role",
        ]);

        //PERMISSION USERS

        Permission::firstOrCreate([
            'name' => "ACCESS_USER",
            'display' => "Access User",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_USER",
            'display' => "Create User",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_USER",
            'display' => "Update User",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_USER",
            'display' => "Delete User",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_USER",
            'display' => "Retrieve User",
        ]);

        //PERMISSION UNIT_TYPE
        Permission::firstOrCreate([
            'name' => "ACCESS_UNIT_TYPE",
            'display' => "Access Unit Type",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_UNIT_TYPE",
            'display' => "Create Unit Type",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_UNIT_TYPE",
            'display' => "Update Unit Type",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_UNIT_TYPE",
            'display' => "Delete Unit Type",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_UNIT_TYPE",
            'display' => "Retrieve Unit_Type",
        ]);

        //PERMISSION ITEM

        Permission::firstOrCreate([
            'name' => "ACCESS_ITEM",
            'display' => "Access Item",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_ITEM",
            'display' => "Create Item",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_ITEM",
            'display' => "Update Item",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_ITEM",
            'display' => "Delete Item",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_ITEM",
            'display' => "Retrieve Item",
        ]);

        //PERMISSION ITEM MATERIALS

        Permission::firstOrCreate([
            'name' => "ACCESS_ITEM_MATERIAL",
            'display' => "Access Item Material",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_ITEM_MATERIAL",
            'display' => "Create Item Material",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_ITEM_MATERIAL",
            'display' => "Update Item Material",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_ITEM_MATERIAL",
            'display' => "Delete Item Material",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_ITEM_MATERIAL",
            'display' => "Retrieve Item Material",
        ]);


        //PERMISSION WARE HOUSES

        Permission::firstOrCreate([
            'name' => "ACCESS_WARE_HOUSE",
            'display' => "Access Ware House",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_WARE_HOUSE",
            'display' => "Create Ware House",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_WARE_HOUSE",
            'display' => "Update Ware House",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_WARE_HOUSE",
            'display' => "Delete Ware House",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_WARE_HOUSE",
            'display' => "Retrieve Ware House",
        ]);

        //PERMISSION MANUFACTURING

        Permission::firstOrCreate([
            'name' => "ACCESS_MANUFACTURING",
            'display' => "Access Manufacturing",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_MANUFACTURING",
            'display' => "Create Manufacturing",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_MANUFACTURING",
            'display' => "Update Manufacturing",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_MANUFACTURING",
            'display' => "Delete Manufacturing",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_MANUFACTURING",
            'display' => "Retrieve Manufacturing",
        ]);

      //PERMISSION PURCHASE
        Permission::firstOrCreate([
            'name' => "ACCESS_PURCHASE",
            'display' => "Access Purchase",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_PURCHASE",
            'display' => "Create  Purchase",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_PURCHASE",
            'display' => "Update  Purchase",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_PURCHASE",
            'display' => "Delete  Purchase",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_PURCHASE",
            'display' => "Retrieve  Purchase",
        ]);

        //PERMISSION SALE

        Permission::firstOrCreate([
            'name' => "ACCESS_SALE",
            'display' => "Access Sale",
        ]);

        Permission::firstOrCreate([
            'name' => "CREATE_SALE",
            'display' => "Create  Sale",
        ]);
        
        Permission::firstOrCreate([
            'name' => "UPDATE_SALE",
            'display' => "Update  Sale",
        ]);
        Permission::firstOrCreate([
            'name' => "DELETE_SALE",
            'display' => "Delete  Sale",

        ]);
        Permission::firstOrCreate([
            'name' => "RETRIEVE_SALE",
            'display' => "Retrieve  Sale",
        ]);



    }
}
