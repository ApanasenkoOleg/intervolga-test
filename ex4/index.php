<?php
class HtmlTextTruncator {
    private $maxWords;  
    private $wordCount; 
    private $stop;      

    public function __construct($maxWords) {
        $this->maxWords = $maxWords;
        $this->wordCount = 0;
        $this->stop = false;
    }

    // Метод обрезки HTML-текста
    public function truncate($text) {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
        $body = $dom->getElementsByTagName('body')->item(0);

        $this->truncateNode($body); // Рекурсивная обрезка узлов

        $truncatedHtml = '';
        foreach ($body->childNodes as $child) {
            $truncatedHtml .= $dom->saveHTML($child); 
        }

        return $truncatedHtml;
    }

    // Рекурсивная обрезка узла
    private function truncateNode($node) {
        if ($this->stop) return; // Останавливаем обработку, если достигнут лимит слов

        if ($node->nodeType === XML_TEXT_NODE) { // Обработка текстовых узлов
            $words = preg_split('/\s+/', $node->nodeValue, -1, PREG_SPLIT_NO_EMPTY);
            $nodeWordCount = count($words);

            if ($this->wordCount + $nodeWordCount > $this->maxWords) {
                // Обрезаем текст и добавляем многоточие
                $node->nodeValue = implode(' ', array_slice($words, 0, $this->maxWords - $this->wordCount)) . '...';
                $this->stop = true;
            } else {
                $this->wordCount += $nodeWordCount; 
            }
        }

        // Рекурсивно обрабатываем дочерние узлы
        foreach ($node->childNodes as $child) {
            $this->truncateNode($child);
        }
    }
}


$text = <<<TXT
<p class="big">
    Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
    <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
    <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
    <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
TXT;


$truncator = new HtmlTextTruncator(29);
echo $truncator->truncate($text);
