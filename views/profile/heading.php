<div class="flex justify-between items-center p-6">
  <h2 class="text-lg md:text-2xl font-bold text-gray-800">
    <?php if ($editMode): ?>
      Edit account details
    <?php else: ?>
      Account Settings
    <?php endif; ?>
  </h2>
  <?php if(!$editMode): ?>
    <a href="<?=  url('public/index.php') ?>" class="hover:underline">
      Go Back
    </a>
  <?php endif ?>
</div>