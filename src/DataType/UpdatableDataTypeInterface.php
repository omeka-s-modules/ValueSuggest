<?php
namespace ValueSuggest\DataType;

use ValueSuggest\Updater\UpdaterInterface;

interface UpdatableDataTypeInterface extends DataTypeInterface
{
    /**
     * Get the updater needed to update values.
     */
    public function getUpdater(): UpdaterInterface;
}
