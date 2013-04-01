<?php

namespace AltCloud\Instance3EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltCloud\Instance3EventBundle\Entity\Agenda
 */
class Agenda
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var text $description
     */
    private $description;

    /**
     * @var AltCloud\Instance3EventBundle\Entity\Event
     */
    private $events;

    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add events
     *
     * @param AltCloud\Instance3EventBundle\Entity\Event $events
     */
    public function addEvent(\AltCloud\Instance3EventBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    }

    /**
     * Get events
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Remove events
     *
     * @param \AltCloud\Instance3EventBundle\Entity\Event $events
     */
    public function removeEvent(\AltCloud\Instance3EventBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }
}