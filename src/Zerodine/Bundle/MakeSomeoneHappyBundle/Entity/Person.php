<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $child;

    /**
     * @ORM\Column(type="text")
     */
    protected $keyPublic;

    /**
     * @ORM\Column(type="text")
     */
    protected $keyPrivate;

    /**
     * @ORM\OneToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id")
     */
    protected $partner;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;

    /**
     * @param mixed $child
     */
    public function setChild($child)
    {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $keyPrivate
     */
    public function setKeyPrivate($keyPrivate)
    {
        $this->keyPrivate = $keyPrivate;
    }

    /**
     * @return mixed
     */
    public function getKeyPrivate()
    {
        return $this->keyPrivate;
    }

    /**
     * @param mixed $keyPublic
     */
    public function setKeyPublic($keyPublic)
    {
        $this->keyPublic = $keyPublic;
    }

    /**
     * @return mixed
     */
    public function getKeyPublic()
    {
        return $this->keyPublic;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $partner
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return mixed
     */
    public function getPartner()
    {
        return $this->partner;
    }


} 