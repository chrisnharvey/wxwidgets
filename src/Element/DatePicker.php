<?php

namespace Encore\Wx\Element;

class DatePicker implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Events;
    use Traits\Wx;
    use Traits\Positionable;
    use Traits\Sizable;

    protected $events = [
        'onDayChange' => wxEVT_CALENDAR_DAY_CHANGED,
        'onMonthChange' => wxEVT_CALENDAR_MONTH_CHANGED,
        'onYearChange' => wxEVT_CALENDAR_YEAR_CHANGED,
        'onChange' => wxEVT_CALENDAR_SEL_CHANGED,
        'onDoubleClick' => wxEVT_CALENDAR_DOUBLECLICKED,
        'onClick' => wxEVT_CALENDAR_WEEKDAY_CLICKED
    ];

    public function init()
    {
        $id = $this->collection->getTrueId($this->id);
        $date = $this->date ? strtotime($this->date) : wxDefaultDateTime;

        $this->element = new \wxCalendarCtrl($this->parent->getParent()->getRaw(), $id, $date, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}