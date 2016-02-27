<?php

namespace maybeworks\minify;

use yii\base\Component;
use yii\base\Event;
use yii\web\Response;
use yii\web\View;
use maybeworks\minify\MinifyHelper;

class MinifyManager extends Component
{

    /**
     * Minify html. Process before response send
     * @var bool
     */
    public $html = true;

    /**
     * Minify css on page, added by registerCss. Process before render page in view component
     * @var bool
     */
    public $css = true;

    /**
     * Minify css on page. Process before render page in view component
     * @var bool
     */
    public $js = true;

    /**
     * Response formats list, where enable minify html
     * @var array
     */
    public $formats = [
        Response::FORMAT_HTML
    ];

    public function init()
    {
        /** @var $this View */
        \Yii::$app->view->on(View::EVENT_END_PAGE, [$this, 'onEventEndPage']);
        \Yii::$app->response->on(Response::EVENT_BEFORE_SEND, [$this, 'onEventBeforeSend']);
    }

    public function onEventEndPage(Event $event)
    {
        $view = $event->sender;

        if ($this->css && !empty($view->css)) {
            foreach ($view->css as &$css) {
                $css = MinifyHelper::css($css);
            }
        }

        if ($this->js && !empty($view->js)) {
            foreach ($view->js as &$list) {
                foreach ($list as &$js) {
                    $js = MinifyHelper::js($js);
                }
            }
        }
    }

    public function onEventBeforeSend(Event $event)
    {
        $response = $event->sender;

        if ($this->html & in_array($response->format, $this->formats)) {
            if (!empty($response->data)) {
                $response->data = MinifyHelper::html($response->data);
            }
            if (!empty($response->content)) {
                $response->content = MinifyHelper::html($response->content);
            }
        }
    }

}
