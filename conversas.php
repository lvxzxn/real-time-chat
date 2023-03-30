<?php
session_start();

if (!isset($_SESSION['isAuthenticated'])) {
    if (!$_SESSION['isAuthenticated']) {
        header("Location: /index.php");
        die();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Real Time - Chat</title>
    <link rel="stylesheet" href="./assets/style/index.css?v=5" />
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="grid h-screen place-items-center text-center">
        <div class="hello-user px-7">
            <h1 class="font-bold text-3xl">
                Olá, <?= $_SESSION['user']['username'] ?>
            </h1>
            <h3 class="text-2xl">
                Escolha com quem você quer iniciar uma conversa.
            </h3>
            <div class="flex chat-messages justify-center mt-5">
                <div class="max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                    <div class="flex justify-center items-center text-center mb-4">
                        <h5 class="text-xl font-bold text-gray-900">Mensagens (3)</h5>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0 cursor-pointer">
                                    <a class="text-sm font-medium text-gray-900 truncate">
                                        Teloschet
                                    </a>
                                </div>
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                    Online
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/users.js?v=100"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            get_users();
        });
    </script>
</body>

</html>