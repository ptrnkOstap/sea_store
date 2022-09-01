<?php

namespace App\Http\Controllers;

use App\Services\Log\LogService;
use App\Services\Log\Contracts\ILogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    private ILogService $logger;
    private $m_start;
    private $t_start;

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
    public function index(){

        $this->logStart();

        $arr = [1, 2, 3, 5, 6 ,8 , 1, 12, 15, 18, 1,2 ,3 ,4, 6, 13, 15 , 17 ];

        echo 'before bubble sort - ' .'['.join(',',$arr).']<br>';

        for ($i=0; $i<sizeof($arr);$i++){
            for($j=0; $j< sizeof($arr)-$i-1;$j++){
                if ($arr[$j]>$arr[$j+1]){
                    $temp =$arr[$j];
                    $arr[$j]=$arr[$j+1];
                    $arr[$j+1]=$temp;
                }
            }
        }
        echo 'after bubble sort - ' .'['.join(',',$arr).']';

        $this->logFinish();
    }
}
