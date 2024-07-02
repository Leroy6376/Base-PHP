<div class="space-y-2">
    <p class="text-xl">Мои группы</p>
    <ul class="list-inside list-disc">
        <?php foreach ($data['groups'] as $group) { ?>
            <li><span class="font-bold"><?=$group['title']?></span> - <?=$group['description']?></li>
        <?php } ?>
    </ul>
</div>