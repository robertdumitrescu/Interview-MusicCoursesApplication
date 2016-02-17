<?php

namespace AppBundle\Controller;

use AppBundle\Services\CourseService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function coursesListingAction(Request $request)
    {
        $path = __DIR__ . "/../Resources/data/courses.json";
        $file = json_decode(file_get_contents($path));


        return new JsonResponse($file);
    }

    /**
     * @param Request $request
     * @param $level
     * @return JsonResponse
     */
    public function coursesListingByLevelAction(Request $request, $level)
    {
        $path = __DIR__ . "/../Resources/data/courses.json";
        $file = json_decode(file_get_contents($path));

        /** @var CourseService $courseService */
        $courseService = $this->get("course");
        $file = $courseService->filterByLevel($file->courses, $level);


        return new JsonResponse($file);
    }

    /**
     * @param Request $request
     * @param $level
     * @param $id
     * @return JsonResponse
     */
    public function courseByIdAndLevelAction(Request $request, $level, $id)
    {
        $path = __DIR__ . "/../Resources/data/courses.json";
        $file = json_decode(file_get_contents($path));

        /** @var CourseService $courseService */
        $courseService = $this->get("course");
        $file = $courseService->getCourseByIdAndLevel($file->courses, $level, $id);


        return new JsonResponse($file);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createCourseAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $courseService = $this->get("course");
        $returnedMsg = $courseService->createCourse($data);

        return new JsonResponse($returnedMsg);
    }
}
