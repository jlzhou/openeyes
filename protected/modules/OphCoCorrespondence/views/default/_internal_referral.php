
<section class="element required">

    <header class="element-header" style="background-color: #fafafa">

        <!-- Element title -->
        <h3 class="element-title">Internal Referral</h3>

    </header>

    <div class="element-fields">
        <div class="row">
            <div class="large-2 column">
                <label>To Service:* </label>
            </div>
            <div class="large-3 column">
                    <?php echo CHtml::activeDropDownList($element, "to_service_id", CHtml::listData(Subspecialty::model()->findAll(array('order' => 'name')), 'id', 'name'), array('empty' => '- None -')) ?>
            </div>

            <div class="large-1 column">&nbsp;</div>

            <div class="large-2 column">
                <label>For Consultant: </label>
            </div>
            <div class="large-3 column end">
                    <?php echo CHtml::activeDropDownList($element, "to_consultant_id",
                                CHtml::listData(User::model()->getAllConsultants(), 'id', 'name'), array('empty' => '- None -')) ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="large-2 column">&nbsp;</div>

            <div class="large-3 column end">
                <label class="inline">
                    <input type="checkbox"> Urgent
                </label>
            </div>

            <div class="large-1 column">&nbsp;</div>

            <div class="large-4 column end">

                <?php

                    $field = 'is_same_condition';
                    $this->widget('application.widgets.RadioButtonList', array(
                        'element' => $element,
                        'name' => CHtml::modelName($element)."[$field]",
                        'label_above' => false,
                        'field_value' => false,
                        'field' => $field,
                        'data' => array(
                                1 => 'Same Condition',
                                0 => 'Different Condition',
                        ),

                    ));

                ?>

            </div>

        </div>

    </div>

</section>