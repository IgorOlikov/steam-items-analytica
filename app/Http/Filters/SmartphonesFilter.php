<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;


//'brand' => 'apple',
//            'screenDiagonal' => 6.0,
//            'screenResolution' => '1920x1080',
//            'os' => 'ios',
//            'memory' => 8,
//            'cores' => 4,

class SmartphonesFilter extends AbstractFilter
{

    public const SCREEN_DIAGONAL = 'screenDiagonal';

    public const SCREEN_RESOLUTION = 'screenResolution';

    public const OS = 'os';

    public const MEMORY = 'memory';

    public const CORES = 'cores';



    protected function getCallbacks(): array
    {
        return [
            self::SCREEN_DIAGONAL => [$this, 'screenDiagonal'],
            self::SCREEN_RESOLUTION => [$this, 'screenResolution'],
            self::OS => [$this, 'os'],
            self::MEMORY => [$this, 'memory'],
            self::CORES => [$this, 'cores'],
        ];
    }

    public function screenDiagonal(Builder $builder, $value): Builder
    {
        return $builder->whereIn('attributes->screenDiagonal', $value);
    }
    public function screenResolution(Builder $builder, $value): Builder
    {
        return $builder->whereIn('attributes->screenResolution', $value);
    }
    public function os(Builder $builder, $value): Builder
    {
        return $builder->whereIn('attributes->os', $value);
    }

    public function memory(Builder $builder, $value): Builder
    {
        return $builder->whereIn('attributes->memory', $value);
    }

    public function cores(Builder $builder, $value): Builder
    {
        return $builder->whereIn('attributes->os', $value);
    }



}