<?php

namespace Encore\Wx\Element;

use Encore\Giml\ElementInterface;

class WebView implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Events;
    use Traits\Wx;

    protected $events = [
        'onLoad' => wxEVT_WEBVIEW_NAVIGATED,
        'onAfterLoad' => wxEVT_WEBVIEW_LOADED,
        'onBeforeLoad' => wxEVT_WEBVIEW_NAVIGATING,
        'onNewWindow' => wxEVT_WEBVIEW_NEWWINDOW,
        'onTitleChange' => wxEVT_WEBVIEW_TITLE_CHANGED,
        'onError' => wxEVT_WEBVIEW_ERROR
    ];

    public function init()
    {
        $id = $this->collection->getTrueId($this->id);

        $this->element = \wxWebView::NewMethod($this->parent->getParent()->getRaw(), $id, $this->url, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}