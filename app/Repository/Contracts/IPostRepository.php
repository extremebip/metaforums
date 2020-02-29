<?php

namespace App\Repository\Contracts;

interface IPostRepository
{
    public function FindAllByUser($userId);
}