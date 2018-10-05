<!-- This page is rendered in form_ElementLetter.php. The <section> tags visible in the DOM come from that file -->
	<header class="element-header"><h3 class="element-title">Attachments</h3></header>
	<div class="element-fields full-width flex-layout">	<table class="cols-10">
			<thead>
			<tr>
				<th>Attachment type</th>
				<th>Title</th>
				<th>Event Date</th>
				<th></th>
			</tr>
			</thead>
            <tbody>
            <?php
            if (empty($patient)) {
                $patient = $this->patient;
            }
            $row_index = 0;
            $event_id_compare = array();

            foreach ($associated_content as $key => $value) {
                $method = null;
                $event_name = null;
                $is_macroinit = false;
                $is_deleted_event = false;

                if (isset($value->initMethod)) {
                    $method = $value->initMethod->method;
                    $ac = $value;
                } else {
                    if (isset($value->initAssociatedContent->initMethod->method)) {
                        $method = $value->initAssociatedContent->initMethod->method;
                        $ac = $value->initAssociatedContent;
                        $is_macroinit = true;
                    } else {
                        $ac = $value;
                    }
                }

                if ($method != null) {
                    $event = json_decode($api->{$method}($patient));
                    if ($event !== null) {
                        $event_name = $event->event_name;
                        $event_date = $event->event_date;
                    }
                } else {
                    $event = Event::model()->findByPk($ac->associated_event_id);
                    if (isset($event->eventType)) {
                        $event_name = $event->eventType->name;
                        $event_date = Helper::convertDate2NHS($event->event_date);
                    } elseif (!is_null($event)) {
                        $event_name = $event->event_name;
                        $event_date = Helper::convertDate2NHS($event->event_date);
                    } else {
                        $event_name = $ac->display_title . ' (deleted)';
                        $event_date = '<i>N/A</i>';
                        $is_deleted_event = true;
                    }
                }

                if (!$is_deleted_event && empty($event)) {
                    continue;
                }

                $event_id = !$is_deleted_event ? $event->id : $ac->associated_event_id;

                $event_id_compare[] = $event_id;
                ?>
                <tr data-id="<?= $row_index ?>">
                    <?php

                    if (isset($_POST['attachments_event_id'])) { ?>

                        <input type="hidden" class="attachments_event_id" name="attachments_event_id[<?= $row_index ?>]"
                               value="<?= $_POST['attachments_event_id'][$row_index] ?>"/>
                    <?php } else if (isset($value->associated_protected_file_id)) { ?>
                        <input type="hidden" class="attachments_event_id" name="attachments_event_id[<?= $row_index ?>]"
                               value="<?= $event_id ?>"/>
                    <?php }

                    if (isset($_POST['attachments_display_title'])) {
                        $display_title = $_POST['attachments_display_title'][$row_index];
                    } else {
                        if (isset($value->display_title) && strlen($value->display_title) > 0) {
                            $display_title = $value->display_title;
                        } else {
                            $display_title = (isset($ac->display_title) ? $ac->display_title : $event_name);
                        }
                    }
                    ?>

                    <td><?= $event_name ?></td>
                    <td><input type="text" class="attachments_display_title"
                               name="attachments_display_title[<?= $row_index ?>]" value="<?= $display_title ?>"/></td>
                    <td>
                        <input type="hidden" name="attachments_event_id[<?= $row_index ?>]" value="<?= $event_id ?>"/>
                        <?php if ($is_macroinit): ?>
                            <input type="hidden" name="attachments_id[<?= $row_index ?>]" value="<?= $ac->id ?>"/>
                        <?php endif; ?>
                        <input type="hidden" name="attachments_system_hidden[<?= $row_index ?>]"
                               value="<?= $ac->is_system_hidden ?>"/>
                        <input type="hidden" name="attachments_print_appended[<?= $row_index ?>]"
                               value="<?= $ac->is_print_appended ?>"/>
                        <input type="hidden" name="attachments_short_code[<?= $row_index ?>]"
                               value="<?= $ac->short_code ?>"/>
                        <?= $event_date ?>
                    </td>
									<td>
										<i class="oe-i trash"></i>
									</td>
                </tr>
                <?php $row_index++;
            }

            if (isset($_POST['attachments_event_id'])) {

                $posted_data = array_diff_assoc($_POST['attachments_event_id'], $event_id_compare);
                if (!empty($posted_data)) {

                    foreach ($posted_data as $pdk => $pdv) {
                        $event = Event::model()->findByPk($pdv);
                        $row_index++;
                        ?>

                        <tr data-id="<?= $row_index ?>">
                            <input type="hidden" name="file_id[<?= $row_index ?>]"
                                   value="<?= $_POST['file_id'][$pdk] ?>"/>
                            <input type="hidden" class="attachments_event_id"
                                   name="attachments_event_id[<?= $row_index ?>]"
                                   value="<?= $_POST['attachments_event_id'][$pdk] ?>"/>
                            <td><?= $event->eventType->name ?></td>
                            <td><input type="text" class="attachments_display_title"
                                       name="attachments_display_title[<?= $row_index ?>]"
                                       value="<?= $_POST['attachments_display_title'][$pdk] ?>"/></td>
                            <td>
                                <?= Helper::convertDate2NHS($event->event_date); ?>
                            </td>
                            <td><i class="oe-i trash"></i></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>

            <tr id="correspondence_attachments_table_last_row" data-id="<?= $row_index ?>">
                <td colspan="2">
                <td>
                <td>
                    <?php

                    $events = $this->getAttachableEvents($patient);

                    echo CHtml::dropDownList(
                        'attachment_events',
                        ' ',
                        CHtml::listData($events, 'id', function ($events) {
                            return CHtml::encode($this->getEventSubType($events) . ' - ' . Helper::convertDate2NHS($events->event_date));

                        }), array('empty' => '- Select -'));
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

