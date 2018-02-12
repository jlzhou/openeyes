<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2017
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2017, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */

?>
<script type="text/javascript" src="<?=$this->getJsPublishedPath('Allergies.js')?>"></script>
<?php
    $model_name = CHtml::modelName($element);

    $missing_req_allergies = $this->getMissingRequiredAllergies();
    $required_allergy_ids = array_map(function($r) { return $r->id; }, $this->getRequiredAllergies());
?>

<div class="element-fields flex-layout full-width" id="<?= $model_name ?>_element">
    <div class="field-row row<?=$this->isAllergiesSetYes($element) ? ' hidden' : ''?>" id="<?=$model_name?>_no_allergies_wrapper">
        <div class="large-3 column">
            <label for="<?=$model_name?>_no_allergies">Confirm patient has no allergies:</label>
        </div>
        <div class="large-2 column end">
            <?php echo CHtml::checkBox($model_name .'[no_allergies]', $element->no_allergies_date ? true : false); ?>
        </div>
    </div>

  <input type="hidden" name="<?= $model_name ?>[present]" value="1" />

  <table id="<?= $model_name ?>_entry_table" class="cols-7 <?= !count($element->entries) ? 'hidden' : ''?>">
    <thead>
    <tr>
      <th>Allergy</th>
      <th>Comments</th>
      <th>Action(s)</th>
    </tr>
    </thead>

      <tbody>

      <?php
      $row_count = 0;
      foreach ($missing_req_allergies as $entry) {
          $this->render(
              'AllergyEntry_event_edit',
              array(
                  'entry' => $entry,
                  'form' => $form,
                  'model_name' => $model_name,
                  'removable' => false,
                  'allergies' => $element->getAllergyOptions(),
                  'field_prefix' => $model_name . '[entries][' . ($row_count) . ']',
                  'row_count' => $row_count,
                  'posted_not_checked' => $element->widget->postedNotChecked($row_count),
                  'has_allergy' => $entry->has_allergy,
              )
          );
          $row_count++;
      }

      foreach ($element->entries as $i => $entry) {
          $this->render(
              'AllergyEntry_event_edit',
              array(
                  'entry' => $entry,
                  'form' => $form,
                  'model_name' => $model_name,
                  'removable' => !in_array($entry->allergy_id, $required_allergy_ids),
                  'allergies' => $element->getAllergyOptions(),
                  'field_prefix' => $model_name . '[entries][' . ($row_count) . ']',
                  'row_count' => $row_count,
                  'posted_not_checked' => $element->widget->postedNotChecked($row_count),
                  'has_allergy' => $entry->has_allergy,
              )
          );
          $row_count++;
      }
      ?>
      </tbody>
  </table>
  <div class="flex-item-bottom" id="history-allergy-popup">
    <button class="button hint green js-add-select-search" type="button"><i class="oe-i plus pro-theme"></i></button>
    <!-- popup to add to element is click -->
    <div id="add-to-allergies" class="oe-add-select-search" style="display: none;">
      <!-- icon btns -->
      <div class="close-icon-btn"><i class="oe-i remove-circle medium"></i></div>
      <div class="select-icon-btn"><i class="oe-i menu selected"></i></div>
      <button class="button hint green add-icon-btn">
        <i class="oe-i plus pro-theme"></i>
      </button>
      <!-- select (and search) options for element -->
      <table class="select-options">
        <tbody>
        <tr>
          <td>
            <div class="flex-layout flex-top flex-left">
              <ul class="add-options" data-multi="true" data-clickadd="false" id="history-allergy-option">
                <?php $allergies = $element->getAllergyOptions();
                    foreach ($allergies as $allergy){ ?>
                      <li data-str = "<?php echo $allergy->name ?>" data-id="<?php echo $allergy->id ?>">
                        <span class="auto-width">
                          <?php echo $allergy->name; ?>
                        </span>
                      </li>
                    <?php } ?>
              </ul></div>
            <!-- flex-layout -->
          </td>
        </tr>
        </tbody>
      </table>
    </div><!-- oe-add-select-search -->
  </div>
</div>

<script type="text/template" id="<?= CHtml::modelName($element).'_entry_template' ?>" class="hidden">
    <?php
    $empty_entry = new \OEModule\OphCiExamination\models\AllergyEntry();
    $this->render(
        'AllergyEntry_event_edit',
        array(
            'entry' => $empty_entry,
            'form' => $form,
            'model_name' => $model_name,
            'removable' => true,
            'allergies' => $element->getAllergyOptions(),
            'field_prefix' => $model_name . '[entries][{{row_count}}]',
            'row_count' => '{{row_count}}',
            'posted_not_checked' => false,
            'values' => array(
                'id' => '',
                'allergy_id' => '{{allergy_id}}',
                'allergy_display' => '{{allergy_display}}',
                'other' => '{{other}}',
                'comments' => '{{comments}}',
                'has_allergy' => (string)\OEModule\OphCiExamination\models\AllergyEntry::$PRESENT,
            )
        )
    );
    ?>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        new OpenEyes.OphCiExamination.AllergiesController({
            element: $('#<?=$model_name?>_element')
        });
    });
</script>
