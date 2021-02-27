"# ivandamary" 
Тестовое задание

В качестве тестового задания вам предлагается написать кусочек кода для сервиса по управлению работой горничных в сети отелей. Каждая уборка, которую делают горничные, записывается в базу данных в таблицу statistics - в ней содержится основная рабочая информация, остальные таблицы содержат справочные данные.
В дампе базы staff (приложен к письму) представлены следующие данные: статистика по уборкам в отеле №2 и несколько справочников: номера, корпуса, пользователи (горничные), типы уборок, цены на уборку.
 
Необходимо написать код, который сделает расчет зарплаты горничной, используя предоставленные данные.
В случае расчёта оплаты за текущую уборку, помимо стоимости самой текучки, также на цену влияет необходимость смены белья и полотенец (параметры bed, towels). Бельё добавляет в сумму 30 руб, полотенца - 10 руб.
Используя предоставленные данные, необходимо написать 2 функции.
 
Первая предоставит отчёт по всем работам, произведенным горничной Чистых Еленой за сентябрь. Данные должны выводиться в виде таблицы со следующими столбцами:
•	Дата (ссылка)
•	Начало рабочего дня (в статистике начало и конец раб.дня - это задача с work=0, начало=`start`)
•	Конец рабочего дня (см предыдущий пункт - конец=`end`)
•	Кол-во генеральных уборок
•	Кол-во текущих уборок
•	Кол-во заездов
•	Сумма оплаты за день

Под таблицей - итоговая сумма за сентябрь.
 
Вторая - при переходе по ссылке с датой - выводит список всех работ, проделанных Чистых Еленой в выбранный день. Данные должны выводиться в виде таблицы со следующими столбцами:
•	Номер (с указанием корпуса)
•	Категория номера
•	Тип уборки
•	Начало уборки
•	Конец уборки
•	Сумма за уборку

Под таблицей - итоговая сумма за день.
