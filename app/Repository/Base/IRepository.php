<?php

namespace App\Repository\Base;

use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    public function FindAll();
    public function FindAllWithDeleted();
    public function Find($id);
    public function FindWithDeleted($id);
    public function InsertUpdate(Model $model);
    public function Delete($id);
    public function RollbackDelete($id);
}