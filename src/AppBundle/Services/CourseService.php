<?php
/**
 * Created by PhpStorm.
 * User: dumitrescu
 * Date: 16.02.2016
 * Time: 15:31
 */

namespace AppBundle\Services;

class CourseService {
    /**
     * @description Filter input courses data by level
     * @param $data
     * @param $level
     * @return array|string
     */
        public function filterByLevel ($data, $level) {
            $filtered_courses = [];
            for ($i = 0; $i < count($data); $i++) {
                if($level == $data[$i]->level) {
                    array_push($filtered_courses, $data[$i]);
                }
            }

            if (count($filtered_courses) == 0) {
                /**
                 * Here further development may occur
                 * We can implement a logger system to track unmatched searches
                 * Also, the error can be handled by a flashbag and the message can be
                 */
                return "There are no results to match the level criteria";
            } else {
                return $filtered_courses;
            }
        }

    /**
     * @description Return a course by level and id
     * @param $data
     * @param $level
     * @param $id
     * @return string
     */
        public function getCourseByIdAndLevel ($data, $level, $id) {
            $filtered_courses = [];
            for ($i = 0; $i < count($data); $i++) {
                if($level == $data[$i]->level && $id == $data[$i]->id) {
                    array_push($filtered_courses, $data[$i]);
                }
            }
            if (count($filtered_courses) == 0) {
                /**
                 * Here further development may occur
                 * We can implement a logger system to track unmatched searches
                 * Also, the error can be handled by a flashbag and the message can be
                 */
                return "There are no results to match the level criteria";
            } else if (count($filtered_courses) > 1){
                /**
                 * Here further development may occur
                 * We can implement a logger system to track dupes occurances in database
                 */
                return $filtered_courses[0];
            } else {
                return $filtered_courses[0];
            }
        }

    /**
     * @param $data
     */
    public function createCourse ($data) {

        $courseAuthor = $data["data"]->author;
        $courseName = $data["data"]->name;
        $courseLevel = $data["data"]->level;
        $courseImage = $data["data"]->imgSrc;

        /**
        Pass the data to a Doctrine handler or a repository for data insertion
         */

        return "The course insertion was successful";
    }

} 