<?php

/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
class OphTrOperationnote_API extends BaseAPI
{
    /**
     * Return the list of procedures as a string for use in correspondence for the given patient and episode.
     * if the $snomed_terms is true, return the snomed_term, otherwise the standard text term.
     *
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return string
     */
    public function getLetterProcedures($patient , $use_context = true)
    {
        $return = '';

        if($plist =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_ProcedureList', $patient, $use_context)){
            foreach ($plist->procedures as $i => $procedure) {
                if ($i) {
                    $return .= ', ';
                }
                $return .= $plist->eye->adjective . ' ' . $procedure->term;
            }
        }

        return $return;
    }

    /*
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return integer
     */
    public function getLetterProceduresBookingEventID($patient, $use_context = true)
    {
        if($plist =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_ProcedureList', $patient, $use_context)){
            return $plist->booking_event_id;
        }
    }

    /*
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return integer
     */
    public function getLastEye( $patient , $use_context = true )
    {
        if($plist =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_ProcedureList', $patient, $use_context)){
            return $plist->eye_id;
        }
    }

    /*
     * Operations carried out with SNOMED terms
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return string
     */
    public function getLetterProceduresSNOMED($patient , $use_context = true)
    {
        $return = '';
        if($plist =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_ProcedureList', $patient, $use_context)){
            foreach ($plist->procedures as $i => $procedure) {
                if ($i) {
                    $return .= ', ';
                }
                $return .= $plist->eye->adjective . ' ' . $procedure->snomed_term;
            }
        }
        return $return;
    }

    public function getOpnoteWithCataractElementInCurrentEpisode($patient, $use_context = true)
    {
        if($episode = $this->getLatestEvent($patient, $use_context)){
            $event_type = EventType::model()->find('class_name=?', array('OphTrOperationnote'));

            $criteria = new CDbCriteria();
            $criteria->compare('episode_id', $episode->episode_id);
            $criteria->compare('event_type_id', $event_type->id);

            return Element_OphTrOperationnote_Cataract::model()
                ->with('event')
                ->find($criteria);
        }
    }

    public function getPatientUniqueCode($patient)
    {
        $patient_latest_event = $patient->getLatestOperationNoteEventUniqueCode();
        $event_unique_code = '';
        if (!empty($patient_latest_event)) {
            $salt = isset(Yii::app()->params['portal']['credentials']['client_id']) ? Yii::app()->params['portal']['credentials']['client_id'] : '';
            $check_digit1 = new CheckDigitGenerator(
                Yii::app()->params['institution_code'] . $patient_latest_event,
                $salt
            );
            $check_digit2 = new CheckDigitGenerator(
                $patient_latest_event . $patient->dob,
                $salt
            );
            $event_unique_code = Yii::app()->params['institution_code'] . $check_digit1->generateCheckDigit()
                . '-' . $patient_latest_event . '-' . $check_digit2->generateCheckDigit();
        }

        return $event_unique_code;
    }

    /**
     * Last operation date
     * @param Patient $patient
     * @param boolean $use_context
     * @return false|string
     */

    public function getLastOperationDate(\Patient $patient , $use_context = true)
    {
        $event = $this->getLatestEvent($patient , $use_context);
        if (isset($event->event_date)) {
            return Helper::convertDate2NHS($event->event_date);
        }
        return '';
    }

    /**
     * Get the last operation date
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return false|string
     */
    public function getLastOperationDateUnformatted(\Patient $patient , $use_context = true)
    {
        $event = $this->getLatestEvent($patient, $use_context);
        if (isset($event->event_date)) {
            return $event->event_date;
        }
        return '';
    }

    /**
     * Get the last operation's surgeon name
     *
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return string
     */

    public function getLastOperationSurgeonName(\Patient $patient, $use_context = true)
    {
        $surgeon_name = '';
        if($surgeon_element =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_Surgeon', $patient, $use_context)){
            $surgeon_name = ($surgeon = User::model()->findByPk($surgeon_element->surgeon_id)) ? $surgeon->getFullNameAndTitle() : '';
        }
        return $surgeon_name;
    }

    /**
     * Get the last operation's location
     *
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return string
     */
    public function getLastOperationLocation(\Patient $patient, $use_context = true )
    {
        $site = '';
        if($site_element =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_SiteTheatre', $patient, $use_context)){
            $site = $site_element->site->name;
        }
        return $site;
    }


    /*
     * Cataract Element from the latest operation note
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     */
    public function getLatestCataractElementForEpisode(\Patient $patient, $use_context = true)
    {
        if($cataract_element =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_Cataract', $patient, $use_context)){
            return $cataract_element;
        }
        return false;
    }

    /**
     * Get the last operation Incision Meridian
     * @param Patient $patient
     * @return string
     */
    public function getLastOperationIncisionMeridian(\Patient $patient)
    {
        $meridian = '';
        $cataract_element = $this->getLatestCataractElementForEpisode($patient);
        if ($cataract_element) {
            $meridian = $cataract_element->meridian . ' degrees';
        }

        return $meridian;
    }

    /**
     * Get the last operation Predicted Refraction
     * @param Patient $patient
     * @return string
     */
    public function getLastOperationPredictedRefraction(\Patient $patient)
    {
        $predicted_refraction = '';
        if ($cataract_element = $this->getLatestCataractElementForEpisode($patient)) {
            $predicted_refraction = $cataract_element->predicted_refraction ?: '';
        }

        return $predicted_refraction;
    }

    /**
     * Get the last operation Details
     * @param Patient $patient
     * @return string
     */
    public function getLastOperationDetails(\Patient $patient)
    {
        $details = '';
        if ($cataract_element = $this->getLatestCataractElementForEpisode($patient)) {
            $details = $cataract_element->report2 ?: '';
        }

        return $details;
    }


    /**
     * Get the last operation Post-op instructions
     * @param Patient $patient
     * @param boolean $use_context - defaults to true
     * @return string
     */

    public function getLastOperationPostOpInstructions(\Patient $patient, $use_context = true )
    {
        if($latest =  $this->getElementFromLatestEvent('Element_OphTrOperationnote_Comments', $patient, $use_context)){
            return $latest->postop_instructions;
        }
        return '';
    }

}
