<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/22
 * Time: 上午11:28
 */
namespace Medoo;

use PDO;
use Exception;
use PDOException;

class Raw {
    public $map;
    public $value;
}

class Medoo
{
    public $pdo;

    protected $type;

    protected $prefix;

    protected $statement;

    protected $option = [];

    protected $logs = [];

    protected $logging = false;

    protected $debug_mode = false;

    protected $guid = 0;

    public function __construct($options = null)
    {
        if (!is_array($options))
        {
            return false;
        }

        if (isset($options[ 'database_type' ]))
        {
            $this->type = strtolower($options[ 'database_type' ]);
        }

        if (isset($options[ 'prefix' ]))
        {
            $this->prefix = $options[ 'prefix' ];
        }

        if (isset($options[ 'option' ]))
        {
            $this->option = $options[ 'option' ];
        }

        if (isset($options[ 'logging' ]) && is_bool($options[ 'logging' ]))
        {
            $this->logging = $options[ 'logging' ];
        }

        if (isset($options[ 'command' ]) && is_array($options[ 'command' ]))
        {
            $commands = $options[ 'command' ];
        }
        else
        {
            $commands = [];
        }

        if (isset($options[ 'dsn' ]))
        {
            if (is_array($options[ 'dsn' ]) && isset($options[ 'dsn' ][ 'driver' ]))
            {
                $attr = $options[ 'dsn' ];
            }

            return false;
        }
        else
        {
            if (
                isset($options[ 'port' ]) &&
                is_int($options[ 'port' ] * 1)
            )
            {
                $port = $options[ 'port' ];
            }

            $is_port = isset($port);

            switch ($this->type)
            {
                case 'mariadb':
                case 'mysql':
                    $attr = [
                        'driver' => 'mysql',
                        'dbname' => $options[ 'database_name' ]
                    ];

                    if (isset($options[ 'socket' ]))
                    {
                        $attr[ 'unix_socket' ] = $options[ 'socket' ];
                    }
                    else
                    {
                        $attr[ 'host' ] = $options[ 'server' ];

                        if ($is_port)
                        {
                            $attr[ 'port' ] = $port;
                        }
                    }

                    // Make MySQL using standard quoted identifier
                    $commands[] = 'SET SQL_MODE=ANSI_QUOTES';
                    break;

                case 'pgsql':
                    $attr = [
                        'driver' => 'pgsql',
                        'host' => $options[ 'server' ],
                        'dbname' => $options[ 'database_name' ]
                    ];

                    if ($is_port)
                    {
                        $attr[ 'port' ] = $port;
                    }

                    break;

                case 'sybase':
                    $attr = [
                        'driver' => 'dblib',
                        'host' => $options[ 'server' ],
                        'dbname' => $options[ 'database_name' ]
                    ];

                    if ($is_port)
                    {
                        $attr[ 'port' ] = $port;
                    }

                    break;

                case 'oracle':
                    $attr = [
                        'driver' => 'oci',
                        'dbname' => $options[ 'server' ] ?
                            '//' . $options[ 'server' ] . ($is_port ? ':' . $port : ':1521') . '/' . $options[ 'database_name' ] :
                            $options[ 'database_name' ]
                    ];

                    if (isset($options[ 'charset' ]))
                    {
                        $attr[ 'charset' ] = $options[ 'charset' ];
                    }

                    break;

                case 'mssql':
                    if (isset($options[ 'driver' ]) && $options[ 'driver' ] === 'dblib')
                    {
                        $attr = [
                            'driver' => 'dblib',
                            'host' => $options[ 'server' ] . ($is_port ? ':' . $port : ''),
                            'dbname' => $options[ 'database_name' ]
                        ];
                    }
                    else
                    {
                        $attr = [
                            'driver' => 'sqlsrv',
                            'Server' => $options[ 'server' ] . ($is_port ? ',' . $port : ''),
                            'Database' => $options[ 'database_name' ]
                        ];
                    }

                    // Keep MSSQL QUOTED_IDENTIFIER is ON for standard quoting
                    $commands[] = 'SET QUOTED_IDENTIFIER ON';

                    // Make ANSI_NULLS is ON for NULL value
                    $commands[] = 'SET ANSI_NULLS ON';
                    break;

                case 'sqlite':
                    $attr = [
                        'driver' => 'sqlite',
                        $options[ 'database_file' ]
                    ];

                    break;
            }
        }

        $driver = $attr[ 'driver' ];

        unset($attr[ 'driver' ]);

        $stack = [];

        foreach ($attr as $key => $value)
        {
            $stack[] = is_int($key) ? $value : $key . '=' . $value;
        }

        $dsn = $driver . ':' . implode($stack, ';');

        if (
            in_array($this->type, ['mariadb', 'mysql', 'pgsql', 'sybase', 'mssql']) &&
            isset($options[ 'charset' ])
        )
        {
            $commands[] = "SET NAMES '" . $options[ 'charset' ] . "'";
        }

        try {
            $this->pdo = new PDO(
                $dsn,
                isset($options[ 'username' ]) ? $options[ 'username' ] : null,
                isset($options[ 'password' ]) ? $options[ 'password' ] : null,
                $this->option
            );

            foreach ($commands as $value)
            {
                $this->pdo->exec($value);
            }
        }
        catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function __call($name, $arguments)
    {
        $aggregation = ['avg', 'count', 'max', 'min', 'sum'];

        if (in_array($name, $aggregation)) {
            array_unshift($arguments, $name);

            return call_user_func_array([$this, 'aggregate'], $arguments);
        }
    }
}