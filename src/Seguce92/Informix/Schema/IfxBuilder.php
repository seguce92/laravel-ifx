<?php

namespace Seguce92\Informix\Schema;

use Illuminate\Database\Schema\Builder;

class IfxBuilder extends Builder
{
    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
        $sql = $this->grammar->compileTableExists();

        //$database = $this->connection->getDatabaseName();

        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select($sql, [$table])) > 0;
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnListing($table)
    {
        //$database = $this->connection->getDatabaseName();

        $table = $this->connection->getTablePrefix().$table;

        $sql = $this->grammar->compileColumnExists($table);

        $results = $this->connection->select($sql, [$table]);

        return $this->connection->getPostProcessor()->processColumnListing($results);
    }
}
