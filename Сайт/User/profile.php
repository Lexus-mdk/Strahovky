<?php 
require '../db/db.php';

$data= $_POST;

if (isset($data['change_name'])) {

        $id = R::findOne('users', 'id = ?', array($_SESSION['logged_user']->id));
        $errors1 = array();

        if (trim ($data['name']) == '') {
            $errors1[] = 'Введите ФИО!';
        }
        if (trim ($data['email']) == '')
        {
            $errors1[] = 'Введите email!';
        }
        if (trim ($data['username']) == '')
        {
            $errors1[] = 'Введите Логин!';
        }

        if (empty($errors1) and isset($id)) {
            $id->name=$data['name'];
            $id->nick=$data['username'];
            $id->email=$data['email'];
            R::store($id);
            $_SESSION['logged_user'] = $id;
        }

        

}

if (isset($data['change_phone'])) 
{
        $id = R::findOne('users', 'id = ?', $_SESSION['logged_user']->id);
        $errors2 = array();

        if (trim ($data['phone']) == '')
        {
            $errors2[] = 'Введите номер телефона!';
        }

        if (empty($errors2) and isset($id)) {
            $id->phone= $data['phone'];
            R::store($id);
            // $_SESSION['logged_user'] = $id;
        }
        
        
}

if (isset($data['change_adress'])) {
    $errors = array();

        $errors = array();

        if (trim ($data['adress']) == '') {
            $errors[] = 'Введите Адрес!';
        }
        if (trim ($data['city']) == '')
        {
            $errors[] = 'Введите Город';
        }
        if (trim ($data['country']) == '')
        {
            $errors[] = 'Введите страну!';
        }
        
        
        
}

require '../header.php'; ?>
    <div class="container-fluid">
        <h1 class="text-center text-dark mb-4">Личный кабинет</h1>
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Связь</h6>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <? if (!empty($errors2))
                                {
                                    
                                    echo '<br>' . '<div style="color: red;">'. array_shift($errors2).'</div>';
                                }
                            ?>
                            <div class="form-group"><label>Контактный телефон</label><input class="form-control" type="tel" placeholder="+70000000000" name="phone" value='<?= $_SESSION['logged_user']->phone ?? '' ?>'></div>
                            <div class="form-group"><button name="change_phone" class="btn btn-primary btn-sm" type="submit">Сохранить</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- <div class="row mb-3 d-none">
                    <div class="col">
                        <div class="card text-white bg-primary shadow">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0">Peformance</p>
                                        <p class="m-0"><strong>65.2%</strong></p>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                </div>
                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-success shadow">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="m-0">Peformance</p>
                                        <p class="m-0"><strong>65.2%</strong></p>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                </div>
                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Настройки пользователя</p>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-row">
                                        <? if (!empty($errors1))
                                            {
                                                echo '<br>' . '<div style="color: red;">'. array_shift($errors1).'</div>';
                                            }
                                        ?>
                                        <div class="col">
                                            <div class="form-group"><label for="username"><strong>Логин</strong><br></label><input class="form-control" type="text" placeholder="user.name" name="username" value="<?= $_SESSION['logged_user']->nick ?? '' ?>"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label for="email"><strong>Email адрес</strong></label><input class="form-control" type="email" placeholder="user@example.com" name="email"  value="<?= $_SESSION['logged_user']->email ?? '' ?>"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="first_name"><strong>ФИО</strong></label><input class="form-control" type="text" placeholder="Иван Иванович Иванов" name="name" value="<?= $_SESSION['logged_user']->name ?? '' ?>"></div>
                                        </div>
                                    </div>
                                    <div class="form-group"><button name="change_name" class="btn btn-primary btn-sm" type="submit">Сохранить&nbsp;</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Контактная информация</p>
                    </div>
                    <div class="card-body">
                        <form  method="post">
                            <div class="form-group"><label for="address"><strong>Адрес</strong></label><input name="address" class="form-control" type="text" placeholder="Пушкинская, 30" name="address"></div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="city"><strong>Город</strong></label><input name="city" class="form-control" type="text" placeholder="Москва" name="city"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="country"><strong>Страна</strong></label><input name="country" class="form-control" type="text" placeholder="Россия" name="country"></div>
                                </div>
                            </div>
                            <div class="form-group"><button name="change_adress" class="btn btn-primary btn-sm" type="submit">Сохранить</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? require "../footer.php";?>