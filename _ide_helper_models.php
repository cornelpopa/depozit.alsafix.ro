<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * Dispatch
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $name
 * @property string $dispatchDate
 * @property int $gescomCodeClient
 * @property string $gescomClientName
 * @property string $gescomCity
 * @property int $agent_id
 * @property string $gescomReferenceOrder
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DispatchElement[] $elements
 * @property-read int|null $elements_count
 * @property-read \App\ShippingInfo|null $shipping_info
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereDispatchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereGescomCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereGescomClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereGescomCodeClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereGescomReferenceOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dispatch whereUserId($value)
 */
	class Dispatch extends \Eloquent {}
}

namespace App{
/**
 * DispatchElement
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $dispatch_id
 * @property string $sku
 * @property string $ean
 * @property int $unit
 * @property string|null $productName
 * @property int $qtyOrdered
 * @property int $qtyDelivered
 * @property int $qtyRemaining
 * @property int $qty
 * @property float $price
 * @property int $sale_unit_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Dispatch|null $dispatch
 * @property-read \App\SaleUnit|null $sale_unit
 * @property-read \App\Sku|null $skuD
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereDispatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereEan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereQtyDelivered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereQtyOrdered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereQtyRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereSaleUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DispatchElement whereUpdatedAt($value)
 */
	class DispatchElement extends \Eloquent {}
}

namespace App{
/**
 * App\Forwarder
 *
 * @property int $id
 * @property string $name
 * @property int $scan_length
 * @property string|null $barcode
 * @property string|null $limits
 * @property string|null $tracking_website
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereLimits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereScanLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereTrackingWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Forwarder whereUpdatedAt($value)
 */
	class Forwarder extends \Eloquent {}
}

namespace App{
/**
 * App\Interest
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Sku[] $skus
 * @property-read int|null $skus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Interest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Interest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interest whereUpdatedAt($value)
 */
	class Interest extends \Eloquent {}
}

namespace App{
/**
 * Inventory
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $observation
 * @property \Illuminate\Support\Carbon $inventoryDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InventoryElement[] $elements
 * @property-read int|null $elements_count
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereInventoryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUserId($value)
 */
	class Inventory extends \Eloquent {}
}

namespace App{
/**
 * InventoryElement
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $inventory_id
 * @property int $sku_id
 * @property string $readSku
 * @property string $readProductName
 * @property int $warehouse
 * @property string $warehouseName
 * @property int $realStock
 * @property int $availableStock
 * @property int $reservedStock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Inventory|null $inventory
 * @property-read \App\Sku|null $sku
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereAvailableStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereReadProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereReadSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereRealStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereReservedStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereWarehouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryElement whereWarehouseName($value)
 */
	class InventoryElement extends \Eloquent {}
}

namespace App{
/**
 * Post
 *
 * @mixin Eloquent
 * @property mixed elements
 * @property mixed name
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReceptionElement[] $elements
 * @property-read int|null $elements_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reception newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reception newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reception query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reception whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reception whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reception whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reception whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reception whereUserId($value)
 */
	class Reception extends \Eloquent {}
}

namespace App{
/**
 * ReceptionElement
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $reception_id
 * @property int $qty
 * @property int $unit
 * @property string $sku
 * @property string $ean
 * @property string|null $productName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Reception|null $reception
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereEan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereReceptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReceptionElement whereUpdatedAt($value)
 */
	class ReceptionElement extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property int $user_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUserId($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\SaleUnit
 *
 * @property int $id
 * @property string $name
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleUnit whereValue($value)
 */
	class SaleUnit extends \Eloquent {}
}

namespace App{
/**
 * App\ShippingInfo
 *
 * @property int $id
 * @property int $dispatch_id
 * @property int $forwarder_id
 * @property string $tracking_number
 * @property string $sms_text
 * @property string $sending_time
 * @property string|null $sent_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Dispatch|null $dispatch
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereDispatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereForwarderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereSendingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereSentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereSmsText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingInfo whereUpdatedAt($value)
 */
	class ShippingInfo extends \Eloquent {}
}

namespace App{
/**
 * Post
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $sku
 * @property string $productName
 * @property int $unit
 * @property int $sale_unit_id
 * @property string $ean
 * @property int $lastInventory_id
 * @property int|null $stock
 * @property int $interest_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DispatchElement[] $dispatchElements
 * @property-read int|null $dispatch_elements_count
 * @property-read \App\Interest|null $interest
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReceptionElement[] $receptionElements
 * @property-read int|null $reception_elements_count
 * @property-read \App\SaleUnit|null $sale_unit
 * @method static \Illuminate\Database\Eloquent\Builder|Sku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sku newQuery()
 * @method static \Illuminate\Database\Query\Builder|Sku onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sku query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereEan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereInterestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereLastInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereSaleUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sku whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Sku withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Sku withoutTrashed()
 */
	class Sku extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $gravatar
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

