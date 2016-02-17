<?php

namespace AppBundle\Controller;

use AppBundle\Services\CourseService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /** @var  CourseService */
    protected $courseServices;

    public function initialize()
    {
        $this->courseServices = $this->get('app.course');
    }

    /**
     * @param   string  $templateName
     *
     * @return  string
     */
    public function getView($templateName)
    {
        return sprintf('AppBundle:Render:%s.html.twig', $templateName);
    }
}