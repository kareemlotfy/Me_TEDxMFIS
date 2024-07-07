<?php
// Check if the search query is provided and not empty or consists of only whitespace characters
if (isset($_GET['query']) && trim($_GET['query']) !== '') {
    // Connect to your database
    $pdo = new PDO('mysql:host=localhost;dbname=tedx', 'root', '');
    
    // Retrieve and sanitize the search query
    $query = trim($_GET['query']);
    $query = htmlspecialchars($query); // Sanitize input to prevent XSS attacks
    
    // Prepare a SQL statement to search for products
    $sql = "SELECT * FROM products WHERE name LIKE :query OR `desc` LIKE :query";
    
    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':query', '%' . $query . '%');
    $stmt->execute();
    
    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Display search results
    if (count($results) > 0) {
        echo "<h2>Search Results:</h2>";

        ?>

<div class="products-wrapper">
        <?php foreach ($results as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

        <?php
    } else {
        echo "<p>No products found.</p>";
    }
} else {
    // If search query is missing, empty, or consists of only whitespace characters, display an error message
    echo "<p>Please provide a valid search query.</p>";
}
?>
