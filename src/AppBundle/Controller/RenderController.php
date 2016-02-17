<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class RenderController extends BaseController
{
    /**
     * @return  Response
     */
    public function homepageAction()
    {
        return $this->render($this->getView('homepage'));
    }
}
