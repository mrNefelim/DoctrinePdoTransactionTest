<?php

namespace DoctrinePdoTransactionTest\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="text", type="string", nullable=false)
     */
    private string $text;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Order
     */
    public function setText(string $text): Order
    {
        $this->text = $text;

        return $this;
    }
}