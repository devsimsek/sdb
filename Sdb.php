<?php

const SDB_READ_ARRAY = 1;
const SDB_READ_OBJ = 2;
const SDB_MAP_PHP = 1;
const SDB_MAP_JSON = 2;

/**
 * smskdb - A New Flat Json Database
 *
 * Simply it reads through input file and outputs php objects/arrays or
 * values directly.
 * You don't need to know any javascript, json or sql.
 * Soon with query engine.
 *
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package     Sdb
 * @subpackage  Sdb
 * @file        Sdb.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */
class Sdb
{
    /**
     * Debug Mode
     * @var bool|mixed $debugMode
     * @since 1.0
     */
    protected $debugMode = false;

    /**
     * Stores directory
     * @var string $directory
     * @since 1.0
     */
    protected $directory;

    /**
     * @var string $dbFile
     * @since 1.0
     */
    protected $dbFile;

    /**
     * Temporary Array
     * @var array $tempArray
     * @since 1.0
     */
    protected $tempArray;

    /**
     * smskdb - A New Flat Json Database
     * Simply it reads through input file and outputs php objects/arrays or
     * values directly.
     * You don't need to know any javascript, json or sql.
     * @param $directory
     * @param false $debugMode
     * @since 1.0
     */
    public function __construct($directory, bool $debugMode = false)
    {
        $this->debugMode = $debugMode;

        $this->debug("Library initialized successfully, Thank you for using smskdb on your project.", "INITIALIZATION");

        if (empty($directory))
            $directory = __DIR__;

        if (substr($directory, -1) != "/")
            $directory .= "/";

        $this->directory = (string)$directory;

        $this->debug("Active Directory: " . $this->directory);
    }

    /**
     * Chmod File
     * @param $file
     * @param false $mode
     * @return bool
     * @since 1.0
     */
    protected function chmod($file, bool $mode = false): bool
    {
        if (!$mode)
            $mode = 0644;
        return @chmod($file, $mode);
    }

    /**
     * Check Database Exists And Validate Format Of It
     * @param $filename
     * @return bool
     * @since 1.0
     */
    protected function check($filename): bool
    {
        return file_exists($filename);
    }

    /**
     * Load Database file
     * @param string $file <p>
     * The <i>database file name</i> to read.
     * </p>
     * @param int $mode [optional] <p>
     * Bitmask of Read Options:<br/>
     * {@see SDB_READ_ARRAY} returns decoded json as array.<br/>
     * {@see SDB_READ_OBJ} returns decoded json as object.<br/>
     * </p>
     * @return mixed <p>
     * Returns Array, Object or Null
     * </p>
     * @uses $directory
     * @since 1.0
     */
    public function load(string $file, int $mode = SDB_READ_ARRAY)
    {
        $file = $this->directory . $file;
        $this->dbFile = $file;
        if (!$this->check($file)) {
            $this->debug("Database " . $file . " does not exists.");
            return null;
        }
        $fileData = file_get_contents($file);
        if (!empty($fileData)) {
            switch ($mode) {
                // Case array
                case SDB_READ_ARRAY:
                    $array = json_decode($fileData, true);
                    if (!empty($array) or is_array($array)) {
                        $this->tempArray = $array;
                        return $array;
                    } else {
                        print_r($array);
                        $this->debug("Error, Database Is Not Formatted Correctly!", "ERROR", true);
                        return false;
                    }
                // Case Object
                case SDB_READ_OBJ:
                default:
                    $array = json_decode($fileData, true);
                    if (!empty($array) or is_array($array)) {
                        $this->tempArray = $array;
                        return json_decode($fileData);
                    } else {
                        $this->debug("Error, Database Is Not Formatted Correctly!", "ERROR", true);
                        return false;
                    }
            }
        } else {
            $this->debug("Error, FileData Is Empty!");
            return false;
        }
    }

    /**
     * Fetch From Array
     * @param string $field
     * @param int $mode [optional] <p>
     * Bitmask of Fetch Options:<br/>
     * {@see SDB_READ_ARRAY} returns decoded json as array.<br/>
     * {@see SDB_READ_OBJ} returns decoded json as object.<br/>
     * </p>
     * @return mixed|null
     * @uses $tempArray
     * @since 1.0
     */
    public function fetch(string $field, int $mode = SDB_READ_ARRAY)
    {
        if (!empty($this->tempArray)) {
            switch ($mode) {
                case SDB_READ_OBJ:
                    return json_decode(json_encode($this->tempArray[$field], true));
                case SDB_READ_ARRAY:
                    return json_decode(json_encode($this->tempArray[$field], false), true);
            }
        }
        return null;
    }

    /**
     * Set Database Field
     * @warning <p>
     * This function does not save to database file. This will store temporarily array in $tempArray</p>
     * @param string $key <p>
     * The json field parameter name that will be applied to the tempJson array.</p>
     * @param mixed $value <p>
     * Value could be array or string.</p>
     * @return bool
     * @uses $tempArray
     * @since 1.0
     */
    public function set(string $key, $value): bool
    {
        if (!empty($this->tempArray)) {
            if (isset($value)) {
                $this->tempArray[$key] = $value;
                if ($this->tempArray[$key] === $value) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Does Database Have Field?
     * @param string $parameter <p>
     * The parameter that will be searched on database
     * </p>
     * @return bool <p>
     * Return's true when database has the field.
     * </p>
     * @uses $tempArray
     * @since 1.0
     */
    public function has(string $parameter): bool
    {
        if (!empty($this->tempArray)) {
            if (isset($this->tempArray[$parameter])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Push array to tempArray array.
     * @warning <p>
     * This function does not save to database file.<br>
     * This will store temporarily array in $tempArray</p>
     * @param mixed $parameter
     * @return bool
     * @uses $tempArray
     * @since 1.0
     */
    public function push($parameter): bool
    {
        if (!empty($this->tempArray)) {
            if (array_push($this->tempArray, $parameter)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Map Database
     * @param int $mode [optional] <p>
     * Bitmask of Fetch Options:<br/>
     * {@see SDB_MAP_PHP} returns php array.<br/>
     * {@see SDB_MAP_JSON} returns decoded json.<br/>
     * </p>
     * @return array|false|string
     * @uses $tempArray
     * @since 1.0
     */
    public function map(int $mode = SDB_MAP_PHP)
    {
        switch ($mode) {
            case SDB_MAP_JSON:
                return json_encode($this->tempArray);
            case SDB_MAP_PHP:
                return $this->tempArray;
        }
        return false;
    }

    /**
     * Remove Key From Database
     * @param mixed $key <p>
     * May be string or integer.</p>
     * @return bool
     * @uses $tempArray
     * @since 1.0
     */
    public function remove($key): bool
    {
        if (!empty($this->tempArray)) {
            if (!empty($this->tempArray[$key])) {
                unset($this->tempArray[$key]);
                if ($this->has($key)) {
                    return false;
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Save temporary data to database file
     * @return bool
     * @uses $tempArray
     * @since 1.0
     */
    public function save(): bool
    {
        if (!empty($this->tempArray)) {
            if (file_exists($this->dbFile) && file_get_contents($this->dbFile) == json_encode($this->tempArray)) {
                touch($this->dbFile);
            }
            if (!$fp = @fopen($this->dbFile, 'wb')) {
                return false;
            }

            fwrite($fp, json_encode($this->tempArray));
            fclose($fp);

            $this->chmod($this->dbFile);
            return true;
        }
        return false;
    }

    /**
     * Create Empty Database
     * @param string $file
     * @return bool
     * @uses $directory
     * @since 1.0
     */
    public function create(string $file): bool
    {
        $file = $this->directory . $file;
        if (!$fp = @fopen($file, 'wb')) {
            return false;
        }

        fwrite($fp, json_encode(array("sdb" => array(
            "createdAt" => date("Y/m/d"),
            "path" => $this->directory,
            "status" => "created_successfully"
        ))));

        fclose($fp);

        $this->chmod($this->dbFile);
        return true;
    }

    /**
     * Delete Database File
     * @param string $filename
     * @return bool
     * @uses $tempArray
     * @since 1.0
     */
    public function delete(string $filename): bool
    {
        $file = $this->directory . $filename;
        if (!$this->check($file)) {
            $this->debug("Database " . $file . " does not exists.", "WARNING", true);
            return false;
        }
        return unlink($this->directory . $filename);
    }

    /**
     * Debug
     * Sdb has a pretty nice debugging function which helps developer to
     * debug their application.
     *
     * @param string $message
     * @param string $flag
     * @param bool $isError
     * @return int
     * @since 1.0
     */
    protected function debug(string $message, string $flag = "INFO", bool $isError = false): int
    {
        if ($this->debugMode) {
            if ($isError) {
                try {
                    throw new Exception("\e[42m[" . date("Y-m-d") . " SDB DEBUG \e[31mFATAL ERROR!\e[0m\e[42m]\e[0m: (" . $flag . ") " . $message);
                } catch (Exception $exception) {
                    error_log("\e[42m[" . date("Y-m-d") . " SDB DEBUG \e[42;31mFATAL ERROR!\e[0m\e[42m]\e[0m: (" . $flag . ") " . $message . PHP_EOL . "ERROR: Can't Throw Exception, " . PHP_EOL . $exception->getMessage());
                }
            } else {
                error_log("\e[42m[" . date("Y-m-d") . " SDB DEBUG]\e[0m: (" . $flag . ") " . $message);
            }
        }
        return 1;
    }
}
