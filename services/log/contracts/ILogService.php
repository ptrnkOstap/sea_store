<?php

namespace App\Services\Log\Contracts;

interface ILogService
{
    public function logStart():void;
    public function logFinish():void;
}
