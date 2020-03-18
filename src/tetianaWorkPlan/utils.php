<?php
    class MakeDay {
    function __construct($day, $month, $year, $startTime = null, $stopTime = null){
        $this->startTime = $startTime;
        $this->stopTime = $stopTime;
        $this->date = $this->createDate($day, $month, $year);
        $this->status();
        $this->render();
    }
    private function createDate($day, $month, $year) {
        $dayNames = ['Понеділок','Вівторок','Середа','Четвер','Пятниця','Субота','Неділя'];
        $monthNames = ["Січня","Лютого","Березня","Квітня","Травня","Червня","Липня","Серпня","Вересня","Жовтня","Листопада","Грудня"];
        $nrDayinWeek = date('N', mktime(0,0,0,$month,$day,$year));
        $dayName = $dayNames[$nrDayinWeek - 1];
        $date = "$day {$monthNames[$month - 1]} $year";
        if (date('d') == $day) {
            $currentDay = true;
        }
        else {
            $currentDay = false;
        }
        return array('dayName' => $dayName, 'day' => $day, 'month' => $month, 'year' => $year, 'date'=> $date, 'nrDayInWeek' => $nrDayinWeek, 'currentDay'=>$currentDay);
    }
    private function render(){
        print <<<PAGE
        <div class="day $this->isWeekend $this->dayDisable $this->currentDay ">
        <h3 class="day-name">{$this->date['dayName']}</h3>
        <span class="date">{$this->date['date']}</span>
        <div class="time-container">
        <span class="start">{$this->startTime}</span>
        <span class="stop">{$this->stopTime}</span>
        </div>
        </div>        
        PAGE;
    }
    private function status (){
        if( 6 == $this->date['nrDayInWeek'] ||  7 == $this->date['nrDayInWeek']) {
            $this->isWeekend = 'day_weekend';
        }
        else {
            $this->isWeekend = '';
        }
        if (!$this->startTime && !$this->stopTime ) {
            $this->dayDisable = 'day_disable';
        }
        elseif (!$this->startTime || !$this->stopTime ) {
            $this->dayDisable = 'error';
        }
        else {
            $this->dayDisable = '';
        }
        if ($this->date['currentDay']){
            $this->currentDay = 'day_current-day';
        }
        else {
            $this->currentDay = '';
        }
    }
}
?>