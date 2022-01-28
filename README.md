Задание: После встречи с заказчиков выяснили, что у них есть потребность загружать и обновлять плоский справочник в БД сайта.
Известно, что размер загружаемого справочника более 100000 строк.

Договорились, что на первом этапе разработки пользователи сайта будут загружать справочники с помощью импорта данных из csv файла. Формат файла: "Код,Название"
Нужно реализовать импорт данных в БД с возможностью обновления по колонке "Код"
"Код" - уникальное значение
"Название" - может содержать русские и английские буквы, цифры, знак "-" и знак "." В случае если есть недопустимые символы не сохранять в БД строку.
После обработки файла пользователю должен скачать файл отчета в формате csv, где будет содержаться строки исходных данных и колонка Error="Недопустимый символ "%s" в поле Название", если в Названии есть символ не из заданного диапазона. Если ошибок нет, колонку Error оставить пустой
Файл отчета должен скачиваться автоматически после окончания обработки.

В результате должен быть php скрипт с html формой загрузки файла.

Требования к реализации:
PHP, MySQL
Написать SQL создания таблицы
Приложить инструкцию в формате README.md

<h2>Инструкция по запуску</h2>
<br>[Билдим, поднимаем]
<br>docker-compose up —build -d
<br>[Накатываем миграции]
<br>docker-compose exec mysql bash /opt/ImportTest/migrate.sh
