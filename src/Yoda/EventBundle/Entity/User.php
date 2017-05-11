<?php 
namespace Yoda\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
/** 
 * 
 * @ORM\Table(name="fos_user") 
 * @ORM\Entity(repositoryClass="Yoda\EventBundle\Repository\UserRepository") 
 */ 

class User extends BaseUser 
{ 
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Yoda\EventBundle\Entity\Event", mappedBy="owner")
     */
    protected $events;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->events = new ArrayCollection();
    }
    
    public function getEvents()
    {
        return $this->events;
    }

//    public function setEvents($events)
//    {
//        $this->events = $events;
//    }
} 