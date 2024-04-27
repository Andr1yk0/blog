<?php

namespace App\Models;

use App\Enums\ConfigTypeEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Config newModelQuery()
 * @method static Builder|Config newQuery()
 * @method static Builder|Config query()
 * @method static Builder|Config whereCreatedAt($value)
 * @method static Builder|Config whereId($value)
 * @method static Builder|Config whereKey($value)
 * @method static Builder|Config whereType($value)
 * @method static Builder|Config whereUpdatedAt($value)
 * @method static Builder|Config whereValue($value)
 *
 * @mixin Eloquent
 */
class Config extends Model
{
    use HasFactory;

    public function value(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value) {
                if ($this->type === ConfigTypeEnum::STRING->value) {
                    return $value;
                } elseif ($this->type === ConfigTypeEnum::INT->value) {
                    return (int) $value;
                } elseif ($this->type === ConfigTypeEnum::BOOL->value) {
                    return (bool) $value;
                } elseif ($this->type === ConfigTypeEnum::ARRAY->value) {
                    return json_decode($value, true);
                }

                return $value;
            },
            set: function (mixed $value) {
                if ($this->type === ConfigTypeEnum::ARRAY->value) {
                    return json_encode($value);
                } elseif ($this->type === ConfigTypeEnum::BOOL->value) {
                    return (int) $value;
                }

                return $value;
            }
        );
    }
}
