<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

umask(0000);

$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

// all our setup is done!!!!!!

//use Yoda\EventBundle\Entity\Event;
//
//$event = new Event();
//$event->setName('Darth\'s surprise birthday party');
//$event->setLocation('Deathstar');
//$event->setTime(new \DateTime('tomorrow noon'));
//$event->setDetails('Ha! Darth HATES surprises!!!!');
//
//$em = $container->get('doctrine')->getManager();
//$em->persist($event);
//$em->flush();

/** @var EntityManager $em */
$em = $container->get('doctrine')->getManager();
$objUser = $em->getRepository('YodaUserBundle:User')->findOneByUsernameOrEmail('martin');

foreach ($objUser->getEvents() as $event){
    var_dump($event->getName());
}