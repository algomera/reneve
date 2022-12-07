<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $business_id
 * @property string $name
 * @property string|null $description
 * @property string $ref
 * @property string $content
 * @property float $price
 * @property string $type
 * @property string $treatment
 * @property string $product_line
 * @property int $qta
 * @property int $put_of_print
 * @property int|null $discount
 * @property int $available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $order
 * @property-read int|null $order_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereavailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePutOfPrint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getTotalAttribute() {
        $price = $this->price;
        $qta = $this->pivot->qta;
        return $price * $qta;
    }

    public function business() {
        return $this->belongsTo(business::class);
    }

    public function order() {
        return $this->belongsToMany(Order::class);
    }
}
