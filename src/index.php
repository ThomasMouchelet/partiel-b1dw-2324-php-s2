<?php
require_once __DIR__ . '/parts/header.php';

try {
    $db_connect = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request = $db_connect->query("SELECT * FROM post");
    $posts = $request->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}
?>
<h1>Liste des Posts</h1>
<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <div class="billet">
            <div class="main-content">
                <div class="title">
                    <?php echo($post['categorie']); ?>
                </div>
                <div class="infos">
                    <?php echo($post['groupe']); ?> - <?php echo($post['equipe1']); ?> vs <?php echo($post['equipe2']); ?> : <?php echo($post['description']); ?>
                </div>
                <div class="date_heure">
                    <?php echo($post['date_heure']); ?> | <?php echo($post['lieu']); ?>
                </div>
            </div>
            <div class="price">
                <?php echo($post['prix']); ?> €
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun post trouvé</p>
<?php endif; ?>

<?php
require_once __DIR__ . '/parts/footer.php';
?>