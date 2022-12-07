<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Business
 *
 * @property int $id
 * @property string $name
 * @property string|null $company_logo
 * @property string|null $p_iva
 * @property string|null $address
 * @property string|null $telephone
 * @property string|null $mobile_phone
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $type_business
 * @property string|null $start_contract
 * @property string|null $end_contract
 * @property int|null $discount
 * @property string $subdomain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cabin[] $cabin
 * @property-read int|null $cabin_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $order
 * @property-read int|null $order_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Provider[] $provider
 * @property-read int|null $provider_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservation
 * @property-read int|null $reservation_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Business newQuery()
 * @method static \Illuminate\Database\Query\Builder|Business onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Business query()
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCompanyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereEndContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business wherePIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business wherePec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereStartContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereSubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereTypeBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Business withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Business withoutTrashed()
 * @mixin \Eloquent
 */
class Business extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user() {
        return $this->belongsToMany(User::class);
    }

    public function product() {
        return $this->belongsToMany(Product::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function providers() {
        return $this->belongsToMany(Provider::class)->withPivot('available', 'price');
    }

    public function cabin() {
        return $this->hasMany(Cabin::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
}
