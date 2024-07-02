<div class="border-b">
    <div class="container mx-auto overflow-hidden px-4 sm:px-6">
        <section class="bg-white py-4">
            <ul class="list-inside bullet-list-item flex flex-wrap justify-between -mx-5 -my-2">
                <?php foreach ($data['menu'] as $item) { ?>
                    <li class="px-5 py-2"><a
                        class="<?= isCurrentUrl(htmlspecialchars($item['path'])) ? 'text-orange cursor-default' : 'text-gray-600 hover:text-orange'?>"
                        href="<?=htmlspecialchars($item['path'])?>"
                        ><?=htmlspecialchars($item['title'])?></a></li>
                <?php } ?>
            </ul>
        </section>
    </div>
</div>