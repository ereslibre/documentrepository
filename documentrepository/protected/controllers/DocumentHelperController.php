<?php

class DocumentHelperController extends Controller
{
    public function getLanguage($language_id)
    {
        $language = Language::model()->findByPk($language_id);
        if (empty($language)) {
            return Yii::t('app', 'Unknown');
        }
        return $language->language;
    }

    public function getRelatedCharacters($document_id)
    {
        $documentCharacters = DocumentCharacter::model()->findAll(array('select'    => 'character_id',
                                                                        'condition' => 'document_id = :document_id',
                                                                        'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentCharacters)) {
            return $res;
        }
        foreach ($documentCharacters as &$documentCharacter) {
            $character = Character::model()->findByPk($documentCharacter->character_id);
            $res[] = Array('id'   => $character->id,
                           'name' => $character->name);
        }
        return $res;
    }

    public function getRelatedInstitutions($document_id)
    {
        $documentInstitutions = DocumentInstitution::model()->findAll(array('select'    => 'institution_id',
                                                                            'condition' => 'document_id = :document_id',
                                                                            'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentInstitutions)) {
            return $res;
        }
        foreach ($documentInstitutions as &$documentInstitution) {
            $institution = Institution::model()->findByPk($documentInstitution->institution_id);
            $res[] = Array('id'   => $institution->id,
                           'name' => $institution->name);
        }
        return $res;
    }

    public function getRelatedEvents($document_id)
    {
        $documentEvents = DocumentEvent::model()->findAll(array('select'    => 'event_id',
                                                                'condition' => 'document_id = :document_id',
                                                                'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentEvents)) {
            return $res;
        }
        foreach ($documentEvents as &$documentEvent) {
            $event = Event::model()->findByPk($documentEvent->event_id);
            $res[] = Array('id'   => $event->id,
                           'name' => $event->name);
        }
        return $res;
    }

    public function printCharacters($data)
    {
        $characters = $this->getRelatedCharacters($data->id);
        if (empty($characters)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($characters as &$character) {
            $character_url = $this->createUrl("character/view", array('id' => $character['id']));
            echo "<li>" . CHtml::link($character['name'], $character_url) . "</li>";
        }
        echo "</ul>";
    }

    public function printInstitutions($data)
    {
        $institutions = $this->getRelatedInstitutions($data->id);
        if (empty($institutions)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($institutions as &$institution) {
            $institution_url = $this->createUrl("institution/view", array('id' => $institution['id']));
            echo "<li>" . CHtml::link($institution['name'], $institution_url) . "</li>";
        }
        echo "</ul>";
    }

    public function printEvents($data)
    {
        $events = $this->getRelatedEvents($data->id);
        if (empty($events)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($events as &$event) {
            $event_url = $this->createUrl("event/view", array('id' => $event['id']));
            echo "<li>" . CHtml::link($event['name'], $event_url) . "</li>";
        }
        echo "</ul>";
    }
}
