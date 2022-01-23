<!--
    Домашнее задание к Уроку 3. Проблемы при использовании шаблонов. Антипаттерны

    1. Провести code review ваших прошлых проектов, чтобы найти использование антипаттернов. Укажите классы и строки, в которых они проявляются. Или найти места, где антипаттерны могли бы появиться, но код написан верно.

    2. Распределить обнаруженные антипаттерны по категориям согласно классификации, рассмотренной на уроке. Предложить способы избавиться от антипаттернов. Были ли случаи, когда их применение было оправданным?
-->

<!--
    Убрал содержание методов для того чтобы не перегружать файл лишним кодом.
-->

<!-- Пример №1. Антипаттерны в ООП > Божественный объект -->

<!--
    Класс DBEntry предназначен для взаимодействия с какой-то базой данных, при этом, в нем также можно заметить такие методы как getRandomWord() и fillDbWithFakeData(). Данные методы не соответствуют изначальной задаче класса. Изначально класс DBEntry предназначался для создания конкретных SQL-запросов в базу данных, а также для предоставления данных запрошенных из базы данных.

    Решение: Для работы с наполнением базы данных фейковыми данными стоило бы создать отдельный класс, который бы и реализовал подобную логику.
-->

<?php
class DBEntry
{
    private string $hostname;
    private string $user;
    private string $password;
    private string $db;
    private mysqli $connection;

    public function __construct($hostname, $user, $password, $db)
    {
        $this->hostname = $hostname;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->connection = mysqli_connect($this->hostname, $this->user, $this->password, $this->db);
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }

    private function makeQuery(string $string){}

    private function getRandomWord(){}

    public function fillDbWithFakeData($recordNumber){}

    public function makeSelectQuery(string $selectQuery){}
}
?>

<!-- Пример №2. Антипаттерны в коде > Спагетти-код -->

<!--
    В данном примере можно заметить следующую вложенность: if > if > foreach > if.
    Также, тут реализуется логика связанная с совершенно разными задачами - Проверка глобальной переменной $_POST; проверка того, была ли инициализирована переменная сессии $_SESSION['cart']; Проверка того, присутствует ли товар в корзине; и тд.

    Решение: Создать отдельную функцию для каждой из проверок для того чтобы код читался лучше. Либо, создать класс для работы с корзиной, который будет реализовывать подобные проверки в своих методах (также распределить задачи по отдельным методам в классе).
-->

<?php
if ($_POST) {
    $newCartItem = [
        'name' => $_POST['good_name'],
        'id' => $_POST['good_id']
    ];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    } else {
        $is_in_array = false;
        foreach ($_SESSION['cart'] as $idx => $cartItem) {
            if ($cartItem['id'] === $newCartItem['id']) {
                $is_in_array = !$is_in_array;
                $existingItemIdx = $idx;
            }
        }
        if ($is_in_array) {
            $_SESSION['cart'][$existingItemIdx]['quantity']++;
        } else {
            $newCartItem['quantity'] = 1;
            $_SESSION['cart'][] = $newCartItem;
        }
    }
}
?>

<!-- Пример №3. Антипаттерны в коде > Жесткое кодирование -->

<!--
    В функции fetchImages() реализовано подключение к базе данных, в котором можно заметить, что параметры hostname, username, password и database были указаны жестко (напрямую).

    Решение: Данные о базе данных вынести в отдельный конфигурационный файл (файл окружения), а работу с базой данных реализовать в отдельном классе, экземпляр которого будет создаваться в функции fetchImages.
-->

<?php
function fetchImages()
{
    global $images;
    $images = [];
    $gallery_db = mysqli_connect('localhost', 'root', '', 'gallery');
    if ($gallery_db) {
        $galleryImages = mysqli_query($gallery_db, "SELECT `name`, `url`, id, view_count FROM images WHERE 1 ORDER BY view_count DESC");
        if ($galleryImages) {
            while ($galleryImage = mysqli_fetch_assoc($galleryImages)) {
                $images[] = $galleryImage;
            }
        }
    }
    mysqli_close($gallery_db);
}
?>

<!-- Пример №4. Антипаттерны в ООП > Приватизация -->

<!--
    В классе ImageUploadHandler есть такие свойства как private array $uploadedImage и private string $localDir, а также такие методы как private function getImageExt(){} и private function getNewImageName(){}. Следуя названию класса, названию его свойств и методов, я предполагаю что его можно было бы расширить в будущем и данные свойства и методы были бы необходимы для потомков данного класса.

    Решение: Сделать своства и методы упомянутые выше защищенными (вместо приватных), таким образом потомки данного класса смогут получить доступ к ним.
-->

<?php
class ImageUploadHandler
{
    private array $uploadedImage;
    private string $localDir;

    public function __construct($uploadedImage, $localDir)
    {
        $this->uploadedImage = $uploadedImage;
        $this->localDir = $localDir;
    }

    private function getImageExt(){}

    private function getNewImageName(){}

    public function getNewImageData(){}

    public function uploadImage($newDir){}
}
?>

<!-- Пример №5. Антипаттерны в коде > Магические числа -->

<!--
    В коде представленном ниже, происходит реализация логики по запросу данных о товарах. При этом при нажатии на кнопку "еще" должно появится еще 25 товаров (+25 к уже отображенным на странице). Но количество товаров, которое должно быть запрошенно при следующем нажатии (25) указано просто в числовом виде, без объяснений.

    Решение: вынести значение количества товаров, которое должно быть запрошено из базы данных в константу, с название, из которого можно будет понять предназначение данного значения.
-->

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $rowNumber = $page * 25;

    $productPageContent = $DBEntry->makeSelectQuery("SELECT id, name, price FROM products WHERE 1 LIMIT 0, $rowNumber");

    header('Content-Type: application/json');
    echo json_encode($productPageContent);
} else {
    $productCount = $DBEntry->makeSelectQuery("SELECT COUNT(*) as 'count' FROM products WHERE 1");
    header('Content-Type: application/json');
    echo json_encode($productCount);
}
?>