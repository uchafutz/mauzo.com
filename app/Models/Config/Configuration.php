<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['key', 'value'];
    public static function getConfiguration(Config $config): String
    {
        $_config = Configuration::where('key', $config->key)->first();
        if ($_config) {
            return $_config->value;
        } else {
            return $config->default;
        }
    }

    public static function configVAT(): Config
    {
        return new Config('CONFIG_VAT', 0.18);
    }
}
class Config
{

    public String $key;
    public String $default;
}