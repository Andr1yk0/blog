<?php

namespace App\Models;

use App\Enums\ConfigTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    public function value(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value){
                if($this->type === ConfigTypeEnum::STRING->value) {
                    return $value;
                }elseif($this->type === ConfigTypeEnum::INT->value) {
                    return (int) $value;
                }elseif($this->type === ConfigTypeEnum::BOOL->value) {
                    return (bool) $value;
                }elseif($this->type === ConfigTypeEnum::ARRAY->value) {
                    return json_decode($value, true);
                }
                return $value;
            },
            set: function(mixed $value){
                if($this->type === ConfigTypeEnum::ARRAY->value) {
                    return json_encode($value);
                }elseif ($this->type === ConfigTypeEnum::BOOL->value) {
                    return (int) $value;
                }
                return $value;
            }
        );
    }
}
