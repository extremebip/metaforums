<?php

namespace App\Repository\Base;

use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    public function FindAll();
    public function FindAllWithDeleted();
    public function FindByID($id);
    public function FindByIDWithDeleted($id);
    public function InsertUpdate(Model $model);
    public function Delete($id);
    public function RollbackDelete($id);
}