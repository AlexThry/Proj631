<?php
    require_once 'functions.php';
    // Test if user is connected
    if(!current_user()) header("Location: ".get_home_url());

    require_once 'includes/header.php';
?>

<style><?php require_once 'assets/css/account.css'; ?></style>

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
        <article class="ligth-frame">
            <?php foreach(current_user()->books() as $book): ?>
                <div class="book">
                    <img src="<?php echo $book->getLink(); ?>" alt="<?php echo $book->getTitle(); ?>">
                    <p><?php echo $book->getTitle(); ?></p>
                </div>
            <?php endforeach; ?>
        </article>
    </section>
</div>

<script src="assets/js/account.js" defer></script>

<?php
require_once 'includes/footer.php';
