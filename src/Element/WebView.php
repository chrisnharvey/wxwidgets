<?php

namespace Encore\Wx\Element;

use Encore\GIML\ElementInterface;

class WebView implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
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

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = \wxWebView::NewMethod($parent->getParent()->getRaw(), $id, $this->url, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }
}