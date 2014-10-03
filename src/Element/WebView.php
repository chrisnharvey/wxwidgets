<?php

namespace Encore\Wx\Element;

use wxWebView;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;
use Encore\Wx\Element\Traits\Events;
use Encore\Giml\ElementInterface;

class WebView implements ElementInterface
{
    use ElementTrait;
    use Sizable;
    use Positionable;
    use Events;
    use Wx;

    protected $events = [
        'onLoad' => wxEVT_WEBVIEW_NAVIGATED,
        'onAfterLoad' => wxEVT_WEBVIEW_LOADED,
        'onBeforeLoad' => wxEVT_WEBVIEW_NAVIGATING,
        'onNewWindow' => wxEVT_WEBVIEW_NEWWINDOW,
        'onTitleChange' => wxEVT_WEBVIEW_TITLE_CHANGED,
        'onError' => wxEVT_WEBVIEW_ERROR
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $id = $this->collection->getTrueId($this->id);

        $this->element = wxWebView::NewMethod($this->parent->getParent()->getRaw(), $id, $this->url, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}