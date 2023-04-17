<?php

class DB
{
    private static ?QueryBuilder $queryBuilder = null;

    /**
     * Initialize the QueryBuilder instance
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $dbname
     * @param string $charset
     *
     * @return QueryBuilder
     */
    public static function initialize(
        string $host = 'localhost',
        string $username = 'root',
        string $password = '',
        string $dbname = 'scandiweb',
        string $charset = 'utf8'
    ): QueryBuilder {
        if (!self::$queryBuilder) {
            self::$queryBuilder = new QueryBuilder($host, $username, $password, $dbname, $charset);
        }

        return self::$queryBuilder;
    }

    /**
     * Proxy method to QueryBuilder::query()
     *
     * @param string $query
     * @param mixed ...$params
     *
     * @return QueryBuilder
     */
    public static function query(string $query, ...$params): QueryBuilder {
        self::initialize();

        return self::$queryBuilder->query($query, ...$params);
    }

    /**
     * Proxy method to QueryBuilder::get()
     *
     * @param null|callable $callback
     *
     * @return array
     */
    public static function get(?callable $callback = null): array {
        self::initialize();

        return self::$queryBuilder->get($callback);
    }

    /**
     * Proxy method to QueryBuilder::close()
     *
     * @return bool
     */
    public static function close(): bool {
        self::initialize();

        return self::$queryBuilder->close();
    }

    /**
     * Proxy method to QueryBuilder::count()
     *
     * @return int
     */
    public static function count(): int {
        self::initialize();

        return self::$queryBuilder->count();
    }

    /**
     * Proxy method to QueryBuilder::affectedRows()
     *
     * @return int
     */
    public static function affectedRows(): int {
        self::initialize();

        return self::$queryBuilder->affectedRows();
    }

    /**
     * Proxy method to QueryBuilder::lastInsertID()
     *
     * @return int
     */
    public static function lastInsertID(): int {
        self::initialize();

        return self::$queryBuilder->lastInsertID();
    }

    /**
     * Proxy method to QueryBuilder::beginTransaction()
     *
     * @return void
     */
    public static function beginTransaction(): void {
        self::initialize();

        self::$queryBuilder->beginTransaction();
    }

    /**
     * Proxy method to QueryBuilder::commit()
     *
     * @return void
     */
    public static function commit(): void {
        self::initialize();

        self::$queryBuilder->commit();
    }

    /**
     * Proxy method to QueryBuilder::rollBack()
     *
     * @return void
     */
    public static function rollBack(): void {
        self::initialize();

        self::$queryBuilder->rollBack();
    }
}