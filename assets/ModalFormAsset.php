<?php

namespace app\assets;

use yii\web\AssetBundle;

class ModalFormAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $css = [
        'css/custom-form.css'
    ];

    public $js = [
        'js/custom-form.js',
    ];
}
