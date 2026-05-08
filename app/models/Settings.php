<?php

class Settings extends CoreModel
{
    public function getAllSettings()
    {
        $sql = "SELECT * FROM settings";
        return $this->getAll($sql);
    }

    public function getSetting($key)
    {
        $sql = "SELECT key_value FROM settings WHERE key_name = :key LIMIT 1";
        $this->query($sql);
        $this->bind(':key', $key);
        $result = $this->single();
        return $result ? $result->key_value : null;
    }

    public function updateSetting($key, $value)
    {
        $sql = "UPDATE settings SET key_value = :value WHERE key_name = :key";
        $this->query($sql);
        $this->bind(':key', $key);
        $this->bind(':value', $value);
        return $this->execute();
    }

    public function settingExists($key)
    {
        $sql = "SELECT COUNT(*) as count FROM settings WHERE key_name = :key";
        $this->query($sql);
        $this->bind(':key', $key);
        $result = $this->single();
        return $result->count > 0;
    }

    public function createSetting($key, $value)
    {
        $sql = "INSERT INTO settings (key_name, key_value) VALUES (:key, :value)";
        $this->query($sql);
        $this->bind(':key', $key);
        $this->bind(':value', $value);
        return $this->execute();
    }
}
