<div class="space-y-2">
    <div class="space-y-2 pb-4 border-b">
        <p class="text-xl">Мой профиль</p>
        <?php foreach ($data['user'] as $item) { ?>
            <?php includeTemplate('profile/userField.php', ['field' => $item]); ?>
        <?php } ?>
    </div>
</div>