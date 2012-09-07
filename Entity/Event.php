<?php

namespace AltCloud\Instance3EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltCloud\Instance3EventBundle\Entity\Event
 */
class Event
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
     * @var datetimetz $start
     */
    private $start;

    /**
     * @var datetimetz $end
     */
    private $end;

    /**
     * @var string $venue
     */
    private $venue;

    /**
     * @var string $image
     */
    private $image;


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
     * Set start
     *
     * @param datetimetz $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * Get start
     *
     * @return datetimetz 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param datetimetz $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * Get end
     *
     * @return datetimetz 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set venue
     *
     * @param string $venue
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    /**
     * Get venue
     *
     * @return string 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @var AltCloud\Instance3MediaBundle\Entity\Media
     */
    private $media;

    /**
     * @var AltCloud\Instance3MediaBundle\Entity\Gallery
     */
    private $gallery;


    /**
     * Set media
     *
     * @param AltCloud\Instance3MediaBundle\Entity\Media $media
     */
    public function setMedia(\AltCloud\Instance3MediaBundle\Entity\Media $media)
    {
        $this->media = $media;
    }

    /**
     * Get media
     *
     * @return AltCloud\Instance3MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set gallery
     *
     * @param AltCloud\Instance3MediaBundle\Entity\Gallery $gallery
     */
    public function setGallery(\AltCloud\Instance3MediaBundle\Entity\Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Get gallery
     *
     * @return AltCloud\Instance3MediaBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
    /**
     * @var AltCloud\Instance3EventBundle\Entity\Agenda
     */
    private $agenda;


    /**
     * Set agenda
     *
     * @param AltCloud\Instance3EventBundle\Entity\Agenda $agenda
     */
    public function setAgenda(\AltCloud\Instance3EventBundle\Entity\Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * Get agenda
     *
     * @return AltCloud\Instance3EventBundle\Entity\Agenda 
     */
    public function getAgenda()
    {
        return $this->agenda;
    }
}