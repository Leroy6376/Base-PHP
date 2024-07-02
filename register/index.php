<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
redirectIsAuthorized();

$showSuccess = false;
$showError = false;
$errorMessage = '';
$request = [];

if (isset($_POST['registration']) ) {
    $request = [
        'name' => $_POST['name'] ?? null,
        'email' => $_POST['email'] ?? null,
        'password' => $_POST['password'] ?? null,
        'password_confirmation' => $_POST['password_confirmation'] ?? null
    ];

    if (!$errorMessage = validateUserProfile($request)) {
        $showSuccess = true;
        $id = createUser($request['name'], $request['email'], $request['password']);
        authorize(['email' => $request['email'], 'id' => $id]);
        setEmailCookie($request['email']);
        $request = [];
    } else {
        $showError = true;
    }
}
?>

<?php includeTemplate('layout/header.php', ['title' => 'Регистрация']); ?>

<?php if ($showError) {
    includeTemplate('messages/error_message.php', ['message' => $errorMessage]);
} ?>
<?php if ($showSuccess) {
    includeTemplate('messages/success_message.php', ['message' => 'Вы успешно зарегистрировались']);
}?>
    <form method="post" action="/register/">
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <div class="block">
                    <label for="fieldName" class="text-gray-700 font-bold">ФИО</label>
                    <input id="fieldName" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($request['name']) ? htmlspecialchars($request['name']) : ''?>" placeholder="Иванов Иван Иваныч">
                </div>
                <div class="block">
                    <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                    <input id="fieldEmail" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($request['email']) ? htmlspecialchars($request['email']) : ''?>" placeholder="john@example.com">
                </div>
                <div class="block">
                    <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                    <input id="fieldPassword" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($request['password']) ? htmlspecialchars($request['password']) : ''?>" placeholder="******">
                </div>
                <div class="block">
                    <label for="fieldPasswordConfirmation" class="text-gray-700 font-bold">Подтверждение пароля</label>
                    <input id="fieldPasswordConfirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?=isset($request['password_confirmation']) ? htmlspecialchars($request['password_confirmation']) : ''?>" placeholder="******">
                </div>
                <div class="block">
                    <button name="registration"  type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Регистрация
                    </button>
                    <a href="/login/" class="inline-block hover:underline focus:outline-none font-bold py-2 px-4 rounded">
                        У меня уже есть аккаунт
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php includeTemplate('layout/footer.php'); ?>