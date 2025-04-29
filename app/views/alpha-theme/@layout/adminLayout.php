<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= ASSETS ?>/img/favicon.png">
    <title>Admin Panel</title>
    <meta name="description" content="ucomfort Admin Panel">
    <link rel="stylesheet" href="<?= ASSETS ?>/css/admin-styles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.action-menu .dots').click(function (e) {
                e.stopPropagation(); // Prevent document click event from closing menu

                // Close all other menus
                $('.action-menu.active').not($(this).parent()).removeClass('active');

                // Toggle the current menu
                $(this).parent().toggleClass('active');
            });

            $(document).click(function (e) {
                // Close all menus
                if (!$('.action-menu').is(e.target) && $('.action-menu').has(e.target).length === 0) {
                    $('.action-menu.active').removeClass('active');
                }
            });
        });
    </script>

    <style>
        .notification-circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #d9d9d9;
            color: black;
            font-size: 10px;
            text-align: center;
            line-height: 20px;
            right: 55px;
            position: absolute;
            margin: -9px -7px;
        }

        .batch {
            width: 10px;
            position: absolute;
            bottom: 10px;
            left: 26px;
            z-index: 10;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="navigation">
            <!-- left panel content here -->
            <div style="padding: 1rem 1.3rem;
    margin-top: 1rem;
    margin-bottom: -2rem;">

                <a href="<?= ROOT ?>/admin"><div class="logo"><?=APP_NAME?></div></a>
                
                <?php
                date_default_timezone_set('Asia/Dhaka');
               // $users = $this->model('AuthModel');
              //  $params['users'] = $users->getUserInfo($_SESSION['userAltName']);

                ?>
            </div>
            <nav class="vertical-menu">
    <a href="<?= ROOT ?>/admin/" class="<?= $_SERVER['REQUEST_URI'] === ROOT . '/admin/' ? 'active' : '' ?>">
        <span class="icon"><i class="uil uil-create-dashboard"></i></span>Dashboard
    </a>
    <?php
    $menuItems = require '../app/views/alpha-theme/@layout/adminMenu.php';

    ?>

    <?php foreach ($menuItems as $route => $item): ?>
        <?php 
            $isActive = str_contains($_SERVER['REQUEST_URI'], "/admin/{$route}") ? 'active' : ''; 
        ?>
        <a href="<?= ROOT ?>/admin/<?= $route ?>" class="<?= $isActive ?>">
            <span class="icon"><i class="uil <?= $item['icon'] ?>"></i></span><?= $item['label'] ?>
        </a>
    <?php endforeach; ?>
</nav>



<!--             
            <nav class="vertical-bottom">
                <a href="<?= ROOT ?>/logout"> <span class="icon"><i class="uil uil-sign-out-alt"></i> </span>Logout</a>
            </nav> -->
        </div>
        <div class="main">
            <header>
                <div class="toggle">
                    <i class="uil uil-bars"></i>
                </div>
                <div class="">
                    <b>Hello, <?php //echo $params['users']['userFirstName']; ?></b>
                    <p class="user_i"><?php echo date('F j, Y l g.i A'); ?></p>
                </div>
                <div class="user">
                    <div style="padding: 0 1rem;">

                        <b><?php //echo $params['users']['userFirstName']; ?>
                            <?php //echo $params['users']['userLastName']; ?>First Last</b>
                        <p class="user_i"> admin <?php //echo $params['users']['userType']; ?>
                            (<a href="<?= ROOT ?>/logout"> <span class="icon"><i class="uil uil-sign-out-alt"></i>
                                </span>Logout</a>)
                        </p>
                    </div>
                    <div class="profile-image">A</div>
                </div>

            </header>
            {{content}}

        </div>
    </div>
    <script>
        // add hovered class to selected list item
        let list = document.querySelectorAll(".navigation li");

        function activeLink() {
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            this.classList.add("hovered");
        }

        list.forEach((item) => item.addEventListener("mouseover", activeLink));

        // Menu Toggle
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function () {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };



    </script>
    <script>
        // Toggle submenu on click
        document.querySelectorAll('.vertical-menu .has-submenu').forEach((menu) => {
            menu.addEventListener('click', function (e) {
                e.preventDefault();
                // Toggle active class to show or hide submenu
                this.classList.toggle('active');
                const submenu = this.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            });
        });

    </script>


</body>

</html>