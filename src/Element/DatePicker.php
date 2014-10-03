<?php

namespace Encore\Wx\Element;

use wxCalendarCtrl;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class DatePicker implements ElementInterface
{
    use ElementTrait;
    use Events;
    use Wx;
    use Positionable;
    use Sizable;

    protected $events = [
        'onDayChange' => wxEVT_CALENDAR_DAY_CHANGED,
        'onMonthChange' => wxEVT_CALENDAR_MONTH_CHANGED,
        'onYearChange' => wxEVT_CALENDAR_YEAR_CHANGED,
        'onChange' => wxEVT_CALENDAR_SEL_CHANGED,
        'onDoubleClick' => wxEVT_CALENDAR_DOUBLECLICKED,
        'onClick' => wxEVT_CALENDAR_WEEKDAY_CLICKED
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $id = $this->collection->getTrueId($this->id);
        $date = $this->date ? strtotime($this->date) : wxDefaultDateTime;

        $this->element = new wxCalendarCtrl($this->parent->getParent()->getRaw(), $id, $date, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}