<?php

Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('install', dirname(dirname(__DIR__)) . '/install');
Yii::setAlias('source', dirname(dirname(__DIR__)).'/source');
Yii::setAlias('data', dirname(__DIR__));
Yii::setAlias('assets', dirname(dirname(__DIR__)).'/web/assets');
Yii::setAlias('attachment', dirname(dirname(__DIR__)) . '/web/attachment');
Yii::setAlias('statics', dirname(dirname(__DIR__)) . '/themes');
Yii::setAlias('themes', dirname(dirname(__DIR__)) . '/themes');
Yii::setAlias('root', dirname(Yii::getAlias('@source')));