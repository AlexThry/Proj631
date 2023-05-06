<?php
    require_once 'functions.php';
    // Test if user is connected
    if(!current_user()) header("Location: ".get_home_url());

    require_once 'includes/header.php';
    echo "<style>";
    require_once 'assets/css/account.css';
    echo "</style>";
?>

<div class="content">
    <section class="infos">
        <aside class="ligth-frame">
            <div class="btn-secondary">Mes livres</div>
            <div class="separator"></div>
            <div class="btn-secondary btn-disabled">Ma WishList</div>
            <div class="separator"></div>
            <div class="btn-secondary btn-disabled">Mes infos</div>
            <div class="separator"></div>
            <div class="btn-secondary btn-disabled">Mon cercle</div>
        </aside>
        <main class="ligth-frame">
            <?php foreach(current_user()->books() as $book): ?>
                <p><?php echo $book->getTitle();?></p>
            <?php endforeach; ?>
        </main>
    </section>
</div>

<script src="assets/js/account.js" defer></script>

<?php
require_once 'includes/footer.php';
