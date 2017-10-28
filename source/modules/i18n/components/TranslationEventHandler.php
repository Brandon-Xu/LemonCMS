<?php
/**
 * User: BrandonXu
 * Date: 2017/10/7
 * Time: 16:30
 */

namespace source\modules\i18n\components;

use source\modules\i18n\models\Message;
use source\modules\i18n\models\SourceMessage;
use yii\i18n\MissingTranslationEvent;

class TranslationEventHandler
{

    public static function handleMissingTranslation(MissingTranslationEvent $event) {
        $sourceMessageData = FALSE;
        if ($event->category !== NULL && $event->message !== NULL) {
            $sourceMessageData = [
                'category' => $event->category,
                'Upper(message)' => "Upper({$event->message})",
            ];
        }

        if ($sourceMessageData === FALSE) {
            $event->translatedMessage = $event->message;
            return TRUE;
        }

        $source = SourceMessage::findOne($sourceMessageData);
        if ($source === NULL) {
            $source = new SourceMessage();
            $source->category = $event->category;
            $source->message = $event->message;
            $source->save();
        }

        $message = new Message();
        $message->id = $source->id;
        $message->language = $event->language;
        $message->translation = $event->message;
        $message->save();

        $event->translatedMessage = $event->message;

        return TRUE;
    }

}