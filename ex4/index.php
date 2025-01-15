<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Скрытие текста</title>
	<link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    </style>
    <script>
        function toggleContent() {
            const hiddenContent = document.querySelector('.hidden-content');
            const toggleLink = document.querySelector('.toggle-content');
            if (hiddenContent.style.display === 'none') {
                hiddenContent.style.display = 'inline';
                toggleLink.textContent = 'Скрыть';
            } else {
                hiddenContent.style.display = 'none';
                toggleLink.textContent = '...';
            }
        }
    </script>
</head>
<body>
<div class="container-sm">
<p class="big">
    Год основания: <b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
    <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
    <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
    <i><b>Великая Отечественная война в истории города</b></i></p>
<p>
    <span>Важнейшей операцией Советской Армии в Великой Отечественной войне стала</span>
    <span class="hidden-content">
        <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.
    </span>
    <span class="toggle-content" onclick="toggleContent()">...</span>
</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>