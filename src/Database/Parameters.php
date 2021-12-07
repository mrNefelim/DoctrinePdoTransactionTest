<?php

namespace DoctrinePdoTransactionTest\Database;

class Parameters
{
    private string $host = 'db';
    private string $port = '3306';
    private string $dataBaseName = 'habitudedb';
    private string $user = 'root';
    private string $password = '';
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Parameters
     */
    public function setHost(string $host): Parameters
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @param string $port
     * @return Parameters
     */
    public function setPort(string $port): Parameters
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataBaseName(): string
    {
        return $this->dataBaseName;
    }

    /**
     * @param string $dataBaseName
     * @return Parameters
     */
    public function setDataBaseName(string $dataBaseName): Parameters
    {
        $this->dataBaseName = $dataBaseName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Parameters
     */
    public function setUser(string $user): Parameters
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Parameters
     */
    public function setPassword(string $password): Parameters
    {
        $this->password = $password;
        return $this;
    }
}