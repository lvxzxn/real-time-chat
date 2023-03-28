<?php

session_start();

if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated'])
{
    header("Location: ./chat.php");
    die(); 
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Real Time - Login</title>
    <link rel="stylesheet" href="./assets/style/index.css?v=5" />
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="grid h-screen place-items-center login-form">
        <div class="max-w-full p-6 bg-zinc border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
            <h1 class="text-3xl font-bold"> Chat Real Time </h1>
            <form action="./api/auth.php" method="POST">
                <div class="flex flex-col gap-3 mt-5">
                    <div class="login-form-username">
                        <div class="relative">
                            <input type="text" id="username" name="username" class="block rounded-t-lg px-3 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="off" required />
                            <label for="username" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-3 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">
                                Usuário
                            </label>
                        </div>
                    </div>
                    <div class="login-form-password">
                        <div class="relative">
                            <input type="password" id="password" name="password" class="block rounded-t-lg px-3 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="off" required />
                            <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-3 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">
                                Senha
                            </label>
                        </div>
                    </div>
                    <div class="login-form-auth mt-2">
                        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-7 py-2.5 text-center mr-2 mb-2">
                            Fazer login
                        </button>
                    </div>
                    <div class="login-form-footer">
                        <p class="text-sm">Ainda não tem uma conta?
                            <a href="/registrar.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Registre-se</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>