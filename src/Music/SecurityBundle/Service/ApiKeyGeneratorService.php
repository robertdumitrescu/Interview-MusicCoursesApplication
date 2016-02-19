<?php

namespace Music\SecurityBundle\Service;

class ApiKeyGeneratorService
{
    /**
     * @return  string
     */
    public function generate()
    {
        return sha1(uniqid(mt_rand(), true));
    }
}