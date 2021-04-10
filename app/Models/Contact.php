<?php

namespace App\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $description
 * @property string|null $country
 * @property string|null $city
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $phone
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ContactFactory factory(...$parameters)
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereAddressLine1($value)
 * @method static Builder|Contact whereAddressLine2($value)
 * @method static Builder|Contact whereCity($value)
 * @method static Builder|Contact whereCountry($value)
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereDescription($value)
 * @method static Builder|Contact whereEmail($value)
 * @method static Builder|Contact whereFirstName($value)
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereLastName($value)
 * @method static Builder|Contact wherePhone($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'country',
        'city',
        'address_line_1',
        'address_line_2',
        'phone',
        'email',
    ];
}
