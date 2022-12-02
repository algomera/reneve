<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cabin
 *
 * @property int $id
 * @property int $business_id
 * @property int $provider_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business $business
 * @property-read \App\Models\Provider|null $provider
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cabin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function provider() {
        return $this->hasOne(Provider::class);
    }
}
