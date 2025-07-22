<div class="service-bw service-bw-lebenslage"><?php

$item = $this->item ?? [];

echo '<h2>' . rex_escape($item['name']) . '</h2>';

foreach ($item['textbloecke'] as $text) {
    echo '<div class="service_bw ' . $text['typ'] . '">';
    if ('' !== @$text['titel']) {
        echo '<h3>' . rex_escape($text['titel']) . '</h3>';
    }
    echo $text['text'];
    echo '</div>';
}

$weitereLebenslagen = $item['lebenslagenbaum']['untergeordneteLebenslagen'] ?? [];

if (count($weitereLebenslagen) > 0) {
    echo '<ul>';
    foreach ($weitereLebenslagen as $lebenslage) {
        $url = rex_getUrl(rex_article::getCurrentId(), '', ['lebenslage' => $lebenslage['id']]);
        echo '<li><a href="' . $url . '" title="' . rex_escape($lebenslage['name']) . '">' . rex_escape($lebenslage['name']) . '</a></li>';
    }
    echo '</ul>';
}

    ?></div>
