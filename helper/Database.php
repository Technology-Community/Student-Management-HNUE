<?php

class Database
{
    private $connection = null;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli(DB['server'], DB['username'], DB['password'], DB['name']);
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die('Can not connect to database. Please check again!');
            return false;
        }
    }

    public function query($sql)
    {
        $query = $this->connection->query($sql);

        if ($query) {
            if (is_object($query)) {
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_object()) {
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            $sql = explode(' ', $sql);
            if ($sql[0] == 'SELECT') {
                return "Don't have records";
            }
            return 'Handle Successfully';
        } else {
            return 'Handle Failed';
        }
    }

    public function queryOne($sql)
    {
        $query = $this->connection->query($sql);
        if ($query) {
            if (is_object($query)) {
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_object()) {
                        $data = $row;
                    }
                    return $data;
                }
            }
            $sql = explode(' ', $sql);
            if ($sql[0] == 'SELECT') {
                return "Don't have records";
            }
            return 'Handle Successfully';
        } else {
            return 'Handle Failed';
        }
    }

    public function create($table, $data)
    {
        if (is_array($data)) {
            $dataKey   = implode(',', array_keys($data));
            $dataValue = [];
            foreach ($data as $value) {
                $dataValue[] = "'$value'";
            }
            $dataValue = implode(',', $dataValue);
            $sql       = "INSERT INTO $table($dataKey) VALUES($dataValue)";

            $created = $this->connection->query($sql);
            if ($created) {
                return true;
            } else {
                return 'Create Failed';
            }
        } else {
            die('Data must be an array');
        }
    }
    public function update($table, $data, $id)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $dataUpdate[] = "$key = '$value'";
            }
            $dataUpdate = implode(',', $dataUpdate);
            $sql       = "UPDATE $table SET $dataUpdate WHERE id = '$id'";
            $updated = $this->connection->query($sql);
            if ($updated) {
                return true;
            } else {
                return 'Update Failed';
            }
        } else {
            die('Data must be an array');
        }
    }

    public function delete($table, $id, $where = [])
    {
        if (!empty($where)) {
            $sql = "DELETE FROM $table WHERE $where[0] = '$id'";
            $deleted = $this->connection->query($sql);
            if ($deleted) {
                return true;
            } else {
                return 'Delete Failed';
            }
        } else {
            $sql = "DELETE FROM $table WHERE id = '$id'";

            $deleted = $this->connection->query($sql);
            if ($deleted) {
                return true;
            } else {
                return 'Delete Failed';
            }
        }
    }
}
