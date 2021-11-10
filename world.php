<?php
  $host = 'localhost';
  $username = 'lab5_user';
  $password = 'password123';
  $dbname = 'world';
  $country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);

  $conn = new PDO("mysql:host = $host; dbname=$dbname; charset = utf8mb4", $username, $password);
  
  $stmt = $conn->query("SELECT * FROM countries");
  $otpt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = $otpt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($_SERVER["REQUEST_METHOD"] == "GET"): ?>
  <?php $country = htmlspecialchars($_GET['country']); ?>

  <?php if (empty($country)):?>
    <ul>
      <?php foreach ($results as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php if (!empty($country)): ?>
    <ul>
      <?php foreach ($output as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>