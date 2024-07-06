<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ContactRequest
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property float $captcha_score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ContactRequest newModelQuery()
 * @method static Builder|ContactRequest newQuery()
 * @method static Builder|ContactRequest query()
 * @method static Builder|ContactRequest whereCreatedAt($value)
 * @method static Builder|ContactRequest whereEmail($value)
 * @method static Builder|ContactRequest whereId($value)
 * @method static Builder|ContactRequest whereMessage($value)
 * @method static Builder|ContactRequest whereName($value)
 * @method static Builder|ContactRequest whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'captcha_score'
    ];
}
