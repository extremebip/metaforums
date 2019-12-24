<?php

namespace App\Repository\Contracts;

interface ITestRepository
{
    public function FindByUsername($username);
}