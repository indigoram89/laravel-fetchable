<?php

namespace Indigoram89\Fetchable;

trait Fetchable
{
    /**
     * Search or create a record in the database
     * and set it on current model instance.
     *
     * @return self
     */
    public function fetch()
    {
        if ($this->exists) {
            return $this;
        }

        $attributes = method_exists($this, 'fetchableAttributes') ? $this->fetchableAttributes() : [];
        $values = method_exists($this, 'fetchableValues') ? $this->fetchableValues() : [];

        $model = $this->firstOrNew($attributes + ['fetchable' => static::class], $values);

        if ( ! $model->exists) {

            if (method_exists($this, 'fetchableSave')) {
                $this->fetchableSave($model);
            }

            $model->save();

            $model = $model->fresh();
        }

        return $model;
    }

    /**
     * Create a new model instance that is existing using the "model" attribute.
     *
     * @param  array  $attributes
     * @param  string|null  $connection
     * @return static
     */
    public function newFromBuilder($attributes = [], $connection = null)
    {
        if ( ! isset($attributes->fetchable)) {
            return parent::newFromBuilder($attributes, $connection);
        }

        $model = (new $attributes->fetchable)->newInstance([], true);

        $model->setRawAttributes((array) $attributes, true);

        $model->setConnection($connection ?: $this->getConnectionName());

        return $model;
    }
}
