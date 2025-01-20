<?php
class HtmlTextTruncator {
    private $maxWords;  
    private $wordCount; 
    private $stop;      

    // Конструктор принимает максимальное количество слов и инициализирует начальные значения
    public function __construct($maxWords) {
        $this->maxWords = $maxWords;
        $this->wordCount = 0;
        $this->stop = false;
    }

    // Публичный метод для обрезки текста
    public function truncate($text) {
        $dom = new DOMDocument(); 
        $dom->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8')); 
        $body = $dom->getElementsByTagName('body')->item(0); 

        $this->truncateNode($body); 

        // Собираем обрезанный HTML, проходя по всем дочерним узлам <body>
        $truncatedHtml = '';
        foreach ($body->childNodes as $child) {
            $truncatedHtml .= $dom->saveHTML($child); 
        }

        return $truncatedHtml;
    }

    // Приватный метод для рекурсивной обработки узлов DOM
    private function truncateNode($node) {
        if ($this->stop) {
            return; 
        }

        if ($node->nodeType == XML_TEXT_NODE) {
            $words = preg_split('/\s+/', $node->nodeValue, -1, PREG_SPLIT_NO_EMPTY); 
            $nodeWordCount = count($words);

            if ($this->wordCount + $nodeWordCount > $this->maxWords) {
                $node->nodeValue = implode(' ', array_slice($words, 0, $this->maxWords - $this->wordCount)) . '...';
                $this->stop = true; 
            } else {
                $this->wordCount += $nodeWordCount; 
            }
        }

        if ($node->hasChildNodes()) {
            foreach ($node->childNodes as $child) {
                $this->truncateNode($child); 
            }
        }
    }
}

// Исходный HTML-текст
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
