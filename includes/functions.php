<?session_start();
function writeLinks($array) {
    $links = '';
    foreach ($array as $page => $options):
        if($_GET['page'] === $page):
            $active = 'active';
        else:
            $active = '';
        endif;
        
        if (!empty($_SESSION['login']) and $options['user']):
            $links .= "<a href='/$page' class='menu__list-link $active'><i class='$options[icon]'></i>$options[name]</a>";
        elseif(!$options['user']):
            $links .= "<a href='/$page' class='menu__list-link $active'><i class='$options[icon]'></i>$options[name]</a>";
        endif;
    endforeach;
    return $links;
}

function writeDate() {
    $arrayMonth = [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    ];
    $month = $arrayMonth[date('n')-1];
    $day = date('d');
    $year = date('Y');
    return "Сегодня $day $month $year год";
}

function pdo() {
    $db = 'phpchsh1600';
    $login = 'root';
    $pass = '';
    return new PDO("mysql:host=localhost;dbname=$db;",$login,$pass);
}

function regist() {
    $pdo = pdo();
    $pass = md5($_POST['pass']);
    $query = $pdo->prepare("INSERT INTO users (name, login, password) VALUES (?,?,?)");
    $query->execute([
        $_POST['name'],
        $_POST['login'],
        $pass
    ]);
}

function confirm($table, $sort = false, $where = false, $arr = []) {
    $pdo = pdo();
    $query = "SELECT * FROM $table ";
    if ($where):
        $query .= $where;
    endif;
    if ($sort):
        $query .= $sort;
    endif;
    $query = trim($query);
    
    $query = $pdo->prepare($query);
    $query->execute($arr);
    return $query->fetchAll(PDO::FETCH_ASSOC);    
}

function addGuest() {
    $pdo = pdo();
    $datetime = date('Y-m-d H:i:s',time()+60*60*2);
    $query = $pdo->prepare("INSERT INTO guest (name, login, text, datetime) VALUES (?,?,?,?)");
    $query->execute([
        $_POST['name'],
        $_POST['login'],
        $_POST['descr'],
        $datetime
    ]);
}

function updateGuest() {
    $pdo = pdo();
    $query = $pdo->prepare("UPDATE guest SET text=:text WHERE id=:id");
    $query->execute([
        'id'=>$_GET['id'],
        'text'=>$_POST['descr']
    ]);
}

function deleteGuest() {
    $pdo = pdo();
    $query = $pdo->prepare("DELETE FROM guest WHERE id=:id");
    $query->execute(["id"=>$_GET['id']]);
}
