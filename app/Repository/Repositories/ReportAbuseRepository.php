<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IReportAbuseRepository;
use App\Model\DB\ReportAbuse;

class ReportAbuseRepository extends BaseRepository implements IReportAbuseRepository
{
    public function __construct() {
        parent::__construct(new ReportAbuse());
    }
}