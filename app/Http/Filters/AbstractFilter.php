<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    private array $queryParams = [];


    public function __construct()
    {
        $this->queryParams  = app()->request->query->all();
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {

                if(str_contains($this->queryParams[$name],'-')) {
                    $paramsArr = explode('-',$this->queryParams[$name]);

                    call_user_func($callback, $builder, ...$paramsArr);
                } else {
                    call_user_func($callback, $builder, $this->queryParams[$name]);
                }
            }
        }
    }



    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
        //
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }


}
