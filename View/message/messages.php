<?php foreach ($messages as $message) { ?>
    <div class="<?php if ($authService->getIsAuth() && ($authService->getUser()->getId() === $message->getUserId())) { ?> current-user <?php } ?>">
        <span class="user-name"><?php echo htmlspecialchars($message->getUser()->getName()) ?></span>
        <p><?php echo htmlspecialchars($message->getContent());?></p>
    </div>
<?php } ?>
