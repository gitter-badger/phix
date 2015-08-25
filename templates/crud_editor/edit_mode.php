<?php
/* ШАБЛОН РЕДАКТИРОВАНИЯ ЭЛЕМЕНТА CRUD */
?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><a class="btn btn-default" href="<? echo $self; ?>"><i class="fa fa-arrow-left"></i></a> <?
            if (!empty($data_in['id'])) echo $page['crud_editor']['messages']['edit_element'] . " #" . $data_in['id'];
            else echo $page['crud_editor']['messages']['create_element'];
            ?></h3>
    </div>
    <form action="?act=add&id=<? echo $data_in['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="panel-body" style="color:#000000;">
            <?
            // Перебор всех полей редактирования
            foreach ($page['crud_editor']['fields'] as $f_name => $f_options) {
                // Проверка прав доступа
                if (empty($f_options['access_show']) || (!empty($f_options['access_show']) && in_array($user_info['user_role'], $f_options['access_show']))) {
                    // Проверка прав изменения
                    if (!empty($f_options['access_edit']) && !in_array($user_info['user_role'], $f_options['access_edit'])) $disabled = ' disabled';
                    else $disabled = '';
                    ?>
                    <div class="row mtop-20">
                        <div class="col-xs-4 text-right"><? echo $f_options['desc']; ?></div>
                        <div class="col-xs-8 text-left">
                            <?		switch ($f_options['tag']) {
                                default:
                                case 'input':
                                    if ($f_options['type'] == 'digit') $type = 'text';
                                    else if ($f_options['type'] == 'timestamp') $type = 'text';
                                    //else if ($f_options['type'] == 'hidden') $type = 'text';
                                    else $type = $f_options['type'];
                                    if (!empty($f_options['default']) && empty($data_in[$f_name])) $data_in[$f_name] = $f_options['default'];
                                    echo '<input type="' . $type . '" name="' . $f_name . '" class="form-control'.$disabled.'" id="" value="' . $data_in[$f_name] . '">';
                                    break;
                                case 'textarea':
                                    echo '<textarea name="' . $f_name . '" rows="5" class="form-control'.$disabled.'" id="">' . $data_in[$f_name] . '</textarea>';
                                    break;
                                case 'select':
                                    echo '<select name="' . $f_name . '" class="form-control" id=""' . $disabled . '>';
                                    if (!empty($f_options['variants'])) {
                                        foreach ($f_options['variants'] as $num => $val) {
                                            echo '<option value="' . $num . '"';
                                            if ($num == $data_in[$f_name]) echo ' selected';
                                            echo '>' . $val . '</option>';
                                        }
                                    } else if (!empty($f_options['mysql_query'])) {
                                        $variants = db_array ($f_options['mysql_query']);
                                        foreach ($variants as $var) {
                                            echo '<option value="' . $var[$f_options['row_id']] . '"';
                                            if ($var[$f_options['row_id']] == $data_in[$f_name]) echo ' selected';
                                            echo '>' . $var[$f_options['row_title']] . '</option>';
                                        }
                                    }
                                    echo '</select>';
                                    break;
                                case 'list': ?>
                                    <div class="row mtop-20">
                                        <div class="col-xs-8">
                                            <input type="text" id="<? echo $f_name; ?>_input" class="form-control input-xs-8" placeholder="<? echo $f_options['input_placeholder']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button" id="<? echo $f_name; ?>_button" class="btn btn-default form-control col-xs-4"><? echo $f_options['add_button_txt']; ?></button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="<? echo $f_name; ?>_id">
                                    <div id="<? echo $f_name; ?>_list"></div>
                                    <?	break;
                                case 'picture': ?>
                                    <div class="row mtop-20">
                                        <div class="col-xs-8">
                                            <div class="row" id="<? echo $f_name; ?>_holder">
                                                <?		$pictures = db_array ("SELECT * FROM `lim_pictures` WHERE `picture_type`='" . $f_options['picture_type'] . "' AND `picture_field`='$f_name' AND `picture_element`='" . $data_in['id'] . "' AND `picture_width`>0 ORDER BY `picture_tst` DESC", true);
                                                if (empty($pictures)) echo '<div class="col-xs-12 text-muted">не загружено ни одной фотографии</div>';
                                                else foreach ($pictures as $picture) { ?>
                                                    <div class="col-md-4" id="picture_<? echo $picture['picture_id']; ?>">
                                                        <div class="thumbnails thumbnail-style">
                                                            <a class="fancybox-button zoomer" data-rel="fancybox-button" title="" href="pictures/<? echo $f_options['picture_type'] . '/' . $picture['picture_filename']; ?>.jpg">
                                <span class="overlay-zoom">
                                    <img class="img-responsive" src="pictures/<? echo $f_options['picture_type'] . '/' . $picture['picture_filename']; ?>.jpg" alt="" />
                                    <span class="zoom-icon"></span>
                                </span>
                                                            </a>
                                                            <div class="caption">
                                                                <p><button type="button" class="btn btn-default btn-xs" onclick="picture_delete(<? echo $picture['picture_id']; ?>);"><i class="fa fa-trash-o"></i></button>
                                                                    <input type="radio" name="<? echo $f_name; ?>" value="<? echo $picture['picture_filename']; ?>"<?
                                                                    if ($picture['picture_filename'] == $data_in[$f_name]) echo ' checked';
                                                                    ?>> Обложка
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?		} ?>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <?	if (!empty($data_in['id'])) { ?>
                                                <button type="button" id="<? echo $f_name; ?>_btn_upload" class="btn btn-default form-control">Загрузить фото</button>
                                                <i class="fa fa-spin fa-spinner" id="<? echo $f_name; ?>_pbar" style="display:none;"></i>
                                            <?	} else echo 'Перед прикреплением фото необходимо сохранить элемент! (Фото прикрепляются к уже сохраненным записям в базе)'; ?>
                                        </div>
                                    </div>
                                    <?	break;
                                case 'checkboxes':
                                    if (!empty($data_in[$f_name]) || $data_in[$f_name] == '0') $checks = explode(',', $data_in[$f_name]);
                                    else $checks = Array();
                                    if (!empty($f_options['variants'])) {
                                        foreach ($f_options['variants'] as $num => $val) {
                                            echo '<div class="checkbox"><label><input type="checkbox"';
                                            echo ' name="' . $f_name . '[]"';
                                            echo ' value="' . $num . '"';
                                            if (array_search($num, $checks) !== false) echo ' checked=""';
                                            echo '> ' . $val . '</label></div>';
                                        }
                                    } else if (!empty($f_options['mysql_query'])) {
                                        $variants = db_array ($f_options['mysql_query']);
                                        foreach ($variants as $var) {
                                            echo '<div class="checkbox"><label><input type="checkbox"';
                                            echo ' name="' . $f_name . '[]"';
                                            echo ' value="' . $var[$f_options['row_id']] . '"';
                                            if (array_search($var[$f_options['row_id']], $checks) !== false) echo ' checked=""';
                                            echo '> ' . $var[$f_options['row_title']] . '</label></div>';
                                        }
                                    }
                                    break;
                            }
                            //if (!empty($f_options['dadata']['yandex_map'])) echo '<div id="' . $f_name . '_map" style="width: 100%; height: 180px"></div>';
                            ?>
                        </div>
                    </div>
                <?		}
            }
            ?>
        </div>
        <div class="panel-footer" style="color:black;">
            <a class="btn btn-default" href="<? echo $self; ?>"><i class="fa fa-arrow-left"></i> Вернуться</a>
            <input type="submit" class="btn btn-success" value="Сохранить изменения"><? //echo $log; ?>
        </div>
    </form>
</div>