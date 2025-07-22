<div class="service-bw service-bw-lebenslagen"><?php

$items = $this->items ?? [];

$list = [];
foreach ($items as $item) {
    $list[strtoupper(mb_substr($item['name'], 0, 1))][] = $item;
}

echo '<h2>Lebenslagen - Service-BW</h2>';

echo '<ul>';
foreach ($list as $key => $value) {
    echo '<li><a href="#goto_' . $key . '">' . $key . '</a></li>';
}
echo '</ul>';

foreach ($list as $key => $value) {
    echo '<h3 id="goto_' . $key . '">' . $key . '</h3>';
    // aktuelle url nehmen und um einen Paramater ergänzen
    $value = array_map(static function ($item) {
        $item['url'] = rex_getUrl(rex_article::getCurrentId(), '', ['lebenslage' => $item['id']]);
        return $item;
    }, $value);
    echo '<ul>';
    foreach ($value as $item) {
        echo '<li><a href="' . $item['url'] . '" title="' . rex_escape($item['name']) . '">' . rex_escape($item['name']) . '</a></li>';
    }
    echo '</ul>';
}

    ?></div>
