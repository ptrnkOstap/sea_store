<?php

namespace App\Services\Log;

use App\Services\Log\Contracts\ILogService;
use Illuminate\Support\Facades\Log;

class LogService implements ILogService
{

    public function __construct(private $t_start=0, private $m_start=0)
    {
        return $this;
    }

    public function logStart(): void
    {
        $this->t_start=time();
        $this->m_start=memory_get_usage(false);

        Log::info('Начал считать в : ', [date('Y-m-d H:i:s', $this->t_start)]);
        Log::info('Пямяти занято в начале : ',[$this->m_start]);
    }

    public function logFinish(): void
    {
        $seconds_spent=(time()-$this->t_start);
        $memory_used=(memory_get_usage(false)-$this->m_start);
        Log::info('Закончил, секунд ушло на процедуру :', [$seconds_spent] );
        Log::info('Пямяти занято во время выполнения процедуры : ',[$memory_used]);
    }
}
