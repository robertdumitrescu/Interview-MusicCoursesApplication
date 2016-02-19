<?php

namespace AppBundle\Controller;

use AppBundle\Exception\EmptyContentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends BaseController
{
    /**
     * @return  JsonResponse
     */
    public function coursesListingAction()
    {
        $this->initialize();

        return new JsonResponse($this->courseServices->findBy([]));
    }

    /**
     * @param   int     $level
     *
     * @return  JsonResponse
     */
    public function coursesListingByLevelAction($level)
    {
        $this->initialize();

        try {
            $response = $this->courseServices->findBy([
                'level' => $level,
            ]);
        } catch (EmptyContentException $ece) {
            /**
             * Here further development may occur
             * We can implement a logger system to track unmatched searches
             * Also, the error can be handled by a flashbag and the message can be
             */
            $response = $ece->getMessage();
        }

        return new JsonResponse($response);
    }

    /**
     * @param   int     $id
     * @param   int     $level
     *
     * @return  JsonResponse
     */
    public function courseByIdAndLevelAction($id, $level)
    {
        $this->initialize();

        try {
            $response = $this->courseServices->findBy([
                'course' => $id,
                'level' => $level,
            ]);
        } catch (EmptyContentException $ece) {
            /**
             * Here further development may occur
             * We can implement a logger system to track unmatched searches
             * Also, the error can be handled by a flashbag and the message can be
             */
            $response = $ece->getMessage();
        }

        return new JsonResponse($response);
    }

    /**
     * @param   Request     $request
     *
     * @return  JsonResponse
     */
    public function createCourseAction(Request $request)
    {
        $this->initialize();
        $data = json_decode($request->getContent(), true);

        return new JsonResponse($this->courseServices->createCourse($data));
    }
}
