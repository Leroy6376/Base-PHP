<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
    <?php foreach ($data['cars'] as $carItem) { ?>
        <?php includeTemplate('catalog/car_item.php', ['car' => $carItem]); ?>
    <?php } ?>
</div>
