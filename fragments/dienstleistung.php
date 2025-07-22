<div class="service-bw service-bw-dienstleistung"><?php

$item = $this->item ?? [];

echo '<h2>' . rex_escape($item['name']) . '</h2>';

foreach ($item['textbloecke'] as $text) {
    echo '<div class="service_bw ' . $text['typ'] . '">';
    if ('' !== @$text['titel'] && '' !== $text['text']) {
        echo '<h3>' . rex_escape($text['titel']) . '</h3>';
    }
    echo $text['text'];
    echo '</div>';
}

$formulare = $item['formulare'] ?? [];
if (count($formulare) > 0) {
    echo '<h2>' . rex_i18n::msg('service_bw_formulare') . '</h2>';
    echo '<ul>';
    foreach ($formulare as $formular) {
        if (isset($formular['url']) && !empty($formular['url'])) {
            echo '<li><a href="' . rex_escape($formular['url']) . '" target="_blank" rel="noopener noreferrer" class="service_bw download" title="' . rex_escape($formular['name']) . '"><i class="rex-icon rex-icon-download"></i> ' . rex_escape($formular['name']) . '</a></li>';
        }
    }
    echo '</ul>';
}

$lebenslagen = $item['lebenslagen'] ?? [];
if (count($lebenslagen) > 0) {
    echo '<h2>' . rex_i18n::msg('service_bw_lebenslagen') . '</h2>';
    echo '<ul>';
    foreach ($lebenslagen as $lebenslage) {
        if (isset($formular['url']) && !empty($formular['url'])) {
            echo '<li><a href="' . rex_getUrl('', '', ['lebenslage' => $lebenslage['id']]) . '" target="_blank" rel="noopener noreferrer" class="service_bw" title="' . rex_escape($formular['name']) . '">' . rex_escape($lebenslage['name']) . '</a></li>';
        }
    }
    echo '</ul>';
}

    ?></div>
