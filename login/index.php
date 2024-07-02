<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
redirectIsAuthorized();

$isAuthorized = isAuthorized();
$showSuccess = false;
$showError = false;
$errorMessage = '';
$showEmailCookie = false;

if ($isAuthorized) {
    $showSuccess = true;
} else {
    if (isSetEmailCookie()) {
        $showEmailCookie = true;
    }
}

if (isset($_POST['authorization']) && !$isAuthorized) {
    $user = findUser($_POST['email']);
    if ($user !== [] && password_verify($_POST['password'], $user['password'])) {
        if ($user['active']) {
            authorize(['email' => $user['email'], 'id' => $user['id']]);
            setEmailCookie($user['email']);
            $isAuthorized = true;
            $showSuccess = true;
        } else {
            $showError = true;
            $errorMessage = 'Доступ запрещен';
        }
    }

    if (!$isAuthorized && $showError !== true) {
        $showError = true;
        $errorMessage = 'Неверно указан логин или пароль';
    }
}
?>

<?php includeTemplate('layout/header.php', ['title' => 'Авторизация']); ?>

<?php if ($showError) {
    includeTemplate('messages/error_message.php', ['message' => $errorMessage]);
} ?>
<?php if ($showSuccess) {
    includeTemplate('messages/success_message.php', ['message' => 'Вы успешно авторизовались']);
}?>

<?php if (!$isAuthorized) { ?>
    <form method="post" action="/login/">
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <div class="block">
                    <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                    <?php if ($showEmailCookie && (!isset($_POST['email']) || $_POST['email'] === '')) { ?>
                        <input id="fieldEmail" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=htmlspecialchars($_COOKIE['email'])?>" placeholder="john@example.com">
                    <?php } else { ?>
                        <input id="fieldEmail" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>" placeholder="john@example.com">
                    <?php } ?>
                </div>
                <div class="block">
                    <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                    <input id="fieldPassword" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''?>" placeholder="******">
                </div>
                <div class="block">
                    <button name="authorization" type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Войти
                    </button>
                    <a href="/register/" class="inline-block hover:underline focus:outline-none font-bold py-2 px-4 rounded">
                        У меня нет аккаунта
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<?php includeTemplate('layout/footer.php'); ?>