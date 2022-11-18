<?php

return [
	
	'user-management' => [
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	'pocontract-management' => [
		'title' => 'PO Contract Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	
	'permissions' => [
		'title' => 'Permissions',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'des'=>'Description'
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'permission' => 'Permissions',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'roles' => 'Roles',
			'remember-token' => 'Remember token',
		],
	],
	'po_contract' => [
		'title' => 'PO Contract',
		'created_at' => 'Time',
		'fields' => [
			'po_no'=>'PO Number',
			'po_date'=>'PO Date',
			'supplier'=>'Supplier',
			'do_no'=>'Invoice Number',
			'do_date'=>'Invoice Date',  
			'remark' => 'Remark'
		],
	],
	'checking' => [
		'title' => 'Checking Management',
		'created_at' => 'Time',
		'fields' => [
			'po_no'=>'PO Contract Number',
			'po_date'=>'PO Date',
			'do_no'=> 'DO Number',
			'do_date'=>'DO Date',
			'status'=>'Status'			
		],
	],
	'tocheck' => [
		'title' => 'To Check',
		'created_at' => 'Time',
		'fields' => [
			'no'=>'NO',
			'po_no'=>'Purchase Order Number',
			'po_date'=>'Purchase Order Date',
			'supplier'=>'Supplier',
			'do_no'=>'Invoice Number',
			'do_date'=>'Invoice Date',  
			'status' => 'Status',
			'quality'=>'Quality',
			'remark'=>'Remark'
		],
	],
	'store' => [
		'title' => 'Stock Management',
		'created_at' => 'Time',
		'fields' => [
			'no'=>'NO',
			'po_no'=>'Purchase Order Number',
			'po_date'=>'Purchase Order Date',
			'supplier'=>'Supplier',
			'do_no'=>'Invoice Number',
			'do_date'=>'Invoice Date',  
			'status' => 'Status',
			'quality'=>'Quality',
			'remark'=>'Remark'
		],
	],
	'do_item' => [
		'title' => 'DO Items',
		'created_at' => 'Time',
		'fields' => [
			'no'=>'NO',
			'action'=>'Action',
			'po_id'=>'PO Contract',
			'item_name'=>'Item Name',
			'received_qty'=>'Receiving Quantity',
			'unit' => 'Unit',
			'qty'=> 'Quantity',
			'price'=>'Price',
			'amt' =>'Amount' , 
			'brand'=>'Brand' ,
			'mfg_country'=>'MFG Country',
			'mfg_company'=>'MFG Company',
			'mfg_date'=>'MFG Date',
			'manual'=>'Manual',
			'remark' => 'Remark',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'app_approved'=> 'Approved',
	'setting'=>'Settings',
	'app_create' =>'Create',
	'app_save' => 'Save',
	'app_edit' => 'Edit',
	'app_view' => 'View',
	'app_chk' => 'Checking',
	'app_update' => 'Update',
	'app_list' => 'List',
	'app_no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'app_logout' => 'Logout',
	'app_add_new' => 'Add New',
	'app_are_you_sure' => 'Are you sure?',
	'app_back_to_list' => 'Back to list',
	'app_dashboard' => 'Dashboard',
	'app_delete' => 'Delete',
	'global_title' => 'Electronic Power Supply',
	'create'=>'Create Checking Form',
	'check'=>'To Check',
	'checked'=>'Checking Completed',
	'supplier'=>[
		'title' => 'Suppliers',
		'created_at' => 'Time',
		'fields' => [
			'name'=>'Name',
			'des'=>'Description',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'unit'=>[
		'title' => 'Unit Measurement',
		'created_at' => 'Time',
		'fields' => [
			'name'=>'Name',
			'des'=>'Description',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'region'=>[
		'title' => 'Regions',
		'created_at' => 'Time',
		'fields' => [
			'd-name'=>'Division',
			't-name'=>'Township',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'division'=>[
		'title' => 'State/Division',
		'created_at' => 'Time',
		'fields' => [
			'name'=>'Division Name',
			'des'=>'Description',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'township'=>[
		'title' => 'Township',
		'created_at' => 'Time',
		'fields' => [
			'name'=>'Township Name',
			'des'=>'Description',
			'created_by'=>'Created_by',
			'updated_by'=>'Updated_by',
			'created_date'=>'Created_date',
			'updated_date'=>'Updated_date',
		],
	],
	'currency'=>[
		'title' => 'Currency',
		'fields' => [
			'name'=>'Name',
			'des' =>'Description',
			'created_by'=>'Created By',
			'updated_by'=>'Updated By',
			'created_date'=>'Created Date',
			'updated_date'=>'Updated Date',
		],
	],
];