<?php
session_start();
include_once "./config.php";

if (!isset($_SESSION['isAuthenticated'])) {
    if (!$_SESSION['isAuthenticated']) {
        header("Location: /index.php");
        die();
    }
}

if (!isset($_GET['userId'])) die("Você deve informar um userId.");

$userId = $_GET['userId'];
$getUserInfoStmt = $dbh->prepare("SELECT * FROM users WHERE ID = :userId");
$getUserInfoStmt->bindValue(':userId', $userId);
$getUserInfoStmt->execute();

$userInfo = $getUserInfoStmt->fetch();

if (!$userInfo) die("Usuário não encontrado.");
if ($userInfo['username'] == $_SESSION['user']['username']) die();

$getUserMessagesStmt_From = $dbh->prepare("SELECT * FROM users_messages WHERE sender = :senderId AND receiver = :receiverId");
$getUserMessagesStmt_From->bindValue(":senderId", $_SESSION['user']['ID']);
$getUserMessagesStmt_From->bindValue(":receiverId", $userInfo['ID']);

$getUserMessagesStmt_To = $dbh->prepare("SELECT * FROM users_messages WHERE receiver = :receiverId AND sender = :senderId");
$getUserMessagesStmt_To->bindValue(":receiverId", $_SESSION['user']['ID']);
$getUserMessagesStmt_To->bindValue(":senderId", $userInfo['ID']);

$getUserMessagesStmt_From->execute();
$getUserMessagesStmt_To->execute();

$userMessagesFrom = $getUserMessagesStmt_From->fetchAll();
$userMessagesTo = $getUserMessagesStmt_To->fetchAll();
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
    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <div class="flex sm:items-center justify-center py-3 border-b-2 border-gray-200">
            <div class="relative flex items-center space-x-4">
                <div class="flex flex-col leading-tight">
                    <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-3">
                            <?= $userInfo['username'] ?>
                        </span>
                        <?php if ($userInfo['online']) { ?>
                            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                    Online
                            </span>
                        <?php } else { ?>
                            <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                                Offline
                            </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            <?php foreach ($userMessagesTo as $userMessageTo) { ?> 
                <div class="chat-message">
                    <div class="flex items-end justify-start">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                            <div>
                                <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                                    <?= htmlspecialchars($userMessageTo['message']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php foreach ($userMessagesFrom as $userMessageFrom) { ?> 
                <div class="chat-message">
                    <div class="flex items-end justify-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                            <div>
                                <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">
                                    <?= htmlspecialchars($userMessageFrom['message']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="border border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
                <div class="relative flex">
                    <input type="text" placeholder="Escreva a sua mensagem!" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
                    <div class="absolute right-0 items-center inset-y-0 sm:flex">
                        <button type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none" onclick="sendMessage()">
                            <span class="font-bold">Enviar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 ml-2 transform rotate-90">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const el = document.getElementById('messages')
            el.scrollTop = el.scrollHeight
        </script>
</body>