<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
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
 * @mixin \Eloquent
 * @property string|null $bar_code
 * @property string $role
 * @property string $last_name
 * @property int|null $foreigner
 * @property string|null $image_profile
 * @property string|null $cf
 * @property string|null $date_of_birth
 * @property string|null $birth_place
 * @property string|null $country_of_birth
 * @property int|null $sex
 * @property int|null $height
 * @property string|null $profession
 * @property string|null $business_name
 * @property string|null $p_iva
 * @property string|null $mobile_phone
 * @property string|null $telephone
 * @property string|null $address
 * @property int|null $civic
 * @property string|null $city
 * @property string|null $province
 * @property string|null $cap
 * @property string|null $allergies
 * @property string|null $interventions
 * @property string|null $patologys
 * @property string|null $medications
 * @property string|null $disturbance
 * @property int $artrosi
 * @property string|null $placche
 * @property string|null $diseases
 * @property int $covid_vaccine
 * @property int $sport
 * @property string|null $diuresi
 * @property string|null $diuresi_qta
 * @property int $menopause
 * @property int $cicle
 * @property int $contraceptive
 * @property int $smoker
 * @property string|null $pregnancy
 * @property string|null $cellulite
 * @property string|null $intestine
 * @property string|null $knows
 * @property int $alimentation
 * @property string|null $alimentation_note
 * @property int $alimentation_follow
 * @property string|null $alimentation_since
 * @property string|null $drenant
 * @property string|null $integration
 * @property int $aesthetics
 * @property int $adipe
 * @property int $skin_relax
 * @property int $teleangectasia
 * @property string|null $body_cream
 * @property string|null $face_cream
 * @property string|null $skin
 * @property string|null $skin_type
 * @property string|null $skin_blemishes
 * @property string|null $body_blemishes
 * @property int $solar_lamp
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Business[] $business
 * @property-read int|null $business_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Images[] $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservation
 * @property-read int|null $reservation_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAesthetics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlimentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlimentationFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlimentationNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlimentationSince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereArtrosi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBodyBlemishes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBodyCream($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCellulite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCicle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCivic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContraceptive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCovidVaccine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDiseases($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDisturbance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDiuresi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDiuresiQta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDrenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFaceCream($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereForeigner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImageProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIntegration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInterventions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIntestine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKnows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMedications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMenopause($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePatologys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlacche($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePregnancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSkin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSkinBlemishes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSkinRelax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSkinType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSmoker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSolarLamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTeleangectasia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function business() {
        return $this->belongsToMany(Business::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }

    public function image() {
        return $this->hasMany(Images::class);
    }

    public function isAdmin() {
        return 'admin' === $this->role;
    }

    public function isBusiness() {
        if ('business' === $this->role) {
            return true;
        } else if ('collaborator' === $this->role) {
            return true;
        }
        return false;
    }

    public function getRedirectRouteName() {
        return match ($this->role) {
            'admin' => 'admin.dashboard',
            'business' => 'business.dashboard',
            'collaborator' => 'business.dashboard',
        };
    }
}
