<?php
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
        <main class="ligth-frame"></main>
    </section>
</div>

<script src="assets/js/account.js" defer></script>

<?php
require_once 'includes/footer.php';
