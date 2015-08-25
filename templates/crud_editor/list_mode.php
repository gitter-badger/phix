<?php
/* ШАБЛОН ВЫВОДА СПИСКА ЭЛЕМЕНТОВ CRUD */
?>
<table id="datatable" class="table">
    <thead>
    <tr>
        <?	// Заголовки колонок таблицы
        foreach ($page['crud_editor']['table_list_fields'] as $field) {
            echo '<th';
            if (!empty($field['width'])) echo ' width="' . $field['width'] . '"';
            echo '>' . $field['desc'] . '</th>';
        }
        if (!$page['crud_editor']['hide_edit']) echo '<th>Действия</th>'; ?>
    </tr>
    </thead>
    <tbody>
    <?	// Построение таблицы со списком элементов
    $elements = db_array ($page['crud_editor']['list_request']);
    $row = 0;
    foreach ($elements as $element) {
        $row ++;
        $element['row'] = $row;
        $element['self'] = $self; ?>
        <tr>
            <?	foreach ($page['crud_editor']['table_list_fields'] as $f_name => $f_options) {
                // Подстановка переменных вместо шаблонов в строковых переменных
                foreach ($f_options as $f_key => $f_option) {
                    if (!is_string($f_option)) continue;
                    // Кастомные вставки-сниппеты вида [[filename.php]]
                    preg_match_all('/\[\[([\w-_]+)\]\]/', $f_options[$f_key], $matches);
                    if (!empty($matches[1])) foreach ($matches[1] as $tmpl_fieldname) {
                        $snippet_output = '';
                        include (MC_ROOT."/pages/snippets/$tmpl_fieldname.php");
                        $f_options[$f_key] = str_replace('[[' . $tmpl_fieldname . ']]', $snippet_output . ' ' . $element[$tmpl_fieldname], $f_options[$f_key]);
                    }
                    // Вставки полей вида {{fieldname}} из текущего запроса
                    preg_match_all('/\{\{(\w+)\}\}/', $f_options[$f_key], $matches);
                    // если найдены шаблонные вставки
                    if (!empty($matches[1])) foreach ($matches[1] as $tmpl_fieldname) {
                        $f_options[$f_key] = str_replace('{{' . $tmpl_fieldname . '}}', $element[$tmpl_fieldname], $f_options[$f_key]);
                    }
                }
                echo '<td>';
                if (!empty($f_options['href'])) {
                    echo '<a href="' . $f_options['href'] . '"';
                    if (!empty($f_options['target_blank'])) echo ' target="_blank"';
                    echo '>';
                }
                if (!empty($f_options['db_request'])) echo db_result( $f_options['db_request'] );
                else if (!empty($f_options['value'])) echo $f_options['value'];
                else echo $element[$f_name];
                if (!empty($f_options['href'])) echo '</a>';
                echo '</td>';
            }
            if (! $page['crud_editor']['hide_edit']) { ?>
                <td>
                    <a class="btn btn-sm btn-info" href="<? echo $self; ?>?id=<? echo $element[$page['crud_editor']['primary_key']]; ?>&act=edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" href="<? echo $self; ?>?id=<? echo $element[$page['crud_editor']['primary_key']]; ?>&act=del" onclick="return confirm('Вы действительно хотите удалить элемент?');">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            <?  } ?>
        </tr>
    <?	} ?>			</tbody>
</table>

<a class="btn btn-success" href="<? echo $self; ?>?act=new"><? echo $page['crud_editor']['messages']['new_element']; ?></a>