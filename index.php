<?php

    //Задача No1.

final class init
 {
    private $mysqli;//Создаем закрытое свойство для работы с БД

    //Создаем конструктор
    public function __construct()
    {
        $this->connect();
        $this->create();
        $this->fill();
    }

    //Подключаемся к БД
    private function connect(){
        $this->mysqli = new mysqli("example.com", "user", "password", "database");
        if ($this->mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    //В закрытом методе create создаем таблицу test
    private function create(){

        //

        if (!$this->mysqli->query("DROP TABLE IF EXISTS test") ||
            !$this->mysqli->query("CREATE TABLE test(id INT, result ENUM('illegal', 'failed', 'success'))")) {
            echo "Не удалось создать таблицу: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
	}

    //В закрытом методе fill создаем данные  и заполняем ими таблицу test
    private function fill(){
        $set_str = 'abcdefghijklmnopqrstuvwxyz';
        $script_name = substr(str_shuffle($set_str), 0, 25);
        $start_time = rand(0, 1000);
        $end_time = rand(0, 1000);


        $items = ['illegal', 'failed', 'success'];

        $result = $items[array_rand($items)];

        if (!$this->mysqli->query("INSERT INTO test('script_name', 'start_time', 'end_time', 'result') VALUES ($script_name, $start_time, $end_time, $result)")) {
            echo "Не удалось создать таблицу: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
    }

    //Из публичного метода get выбираем из таблицы test данные 'success'
    public function get(){
        $result= $this->mysqli->query("SELECT * FROM test WHERE result = 'success'");

        $data = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            return false;
        }


        return $data;
    }

}


    //Задача No2.

/*

// Меняем MyISAM на InnoDB
//

CREATE TABLE `info` (
`id` int(11) NOT NULL auto_increment,
`name` varchar(255) default NULL,
`desc` text default NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf-8;

CREATE TABLE `data` (
`id` int(11) NOT NULL auto_increment,
`date` date default NULL,
`value` INT(11) default NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf-8;

CREATE TABLE `link` (
`data_id` int(11) NOT NULL,
`info_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf-8;

foreign key (data_id) references data(id)
create index data_id
    on link (data_id);

foreign key (info_id) references info(id)
create index info_id
    on link (info_id);

select * from data
inner join link
on link.data_id = data.id
inner join info
on link.info_id = info.id;
*/


    //Задача No3.

$objects = new DirectoryIterator('datafiles'); //Получаем объекты всех файлов и папок, находящихся в директории "datafiles"


foreach($objects as $object){ //Проходим циклом

    if( preg_match( '~^[[:alnum:]]+\.ixt$~', $object->getFileName() ) ) //Делаем проверку,должен содержать латинские буквы и цифры и расширение ixt

        echo $object->getFileName() . PHP_EOL; //Выводим имя файла
}



    //Задача No4.

$site_content = file_get_contents('https://mirinstrumenta.ua/'); //Считываем файл

$matches = preg_match_all('/tel:(\+\d+)/', $site_content); //Ищем все телефоны

$phones = $matches[1]; //Получаем только первую ячейку массива

$matches_titles = preg_match_all('/tel:(\+\d+)/', $site_content); //Ищем все заголовки

$titles = $matches_titles[1]; //Получаем только первую ячейку массива

$matches_links = preg_match_all('/<a href="(\/brand\/\w+\.html)">/', $site_content); //Ищем все ссылки брендов

$links = $matches_links[1]; //Получаем только первую ячейку массива


$link = mysqli_connect("localhost","root","","test1") or die(mysqli_error($link)); // Подключаемся к БД test1

//Проходимся циклом по всем полученным данным и сохраняем их в таблицу loot
foreach ($phones as $phone){
    mysqli_query($link,"INSERT INTO loot(phone) VALUES ($phone)");
}

foreach ($titles as $title){
    mysqli_query($link,"INSERT INTO loot(title) VALUES ($title)");
}

foreach ($links as $link){
    mysqli_query($link,"INSERT INTO loot(url) VALUES ($link)");
}

?>


<!--Задача No5.-->

<!--Создаем кнопки-->
<form action="index.php" method="post">
   <input type = "button" name="bottom1" value = "1"><br>
   <input type = "button" name="bottom2" value = "2"><br>
   <input type = "button" name="bottom3" value = "3"><br>
</form name="form">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script>
    jQuery(document).ready(function(){
        jQuery('input').click(function(){
            jQuery('input').each(function(){  <!--Обращаемся к каждому элементу input-->
                var value = jQuery(this).val();

                var newValue = 1*value+1; <!--Приводим каждое значение к числу и прибавляем к нему 1-->

                if(newValue == 4){
                    newValue = 1;<!--Если получается 4,то меняем ее на 1-->
                }

                jQuery(this).val(newValue);
            });
        })
    });
</script>

<!-- Сайт на laravel http://h66705at.beget.tech/ -->