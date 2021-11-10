<?php
  $host = 'localhost';
  $username = 'lab5_user';
  $password = 'password123';
  $dbname = 'world';
  $country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);

  $conn = new PDO("mysql:host = $host; dbname=$dbname; charset = utf8mb4", $username, $password);
  
  $stmt = $conn->query("SELECT * FROM countries");
  $otpt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $rslt = $conn->query("SELECT * FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = $otpt->fetchAll(PDO::FETCH_ASSOC);
  $cities = $rslt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($_SERVER["REQUEST_METHOD"] == "GET"): ?>
  <?php $country = htmlspecialchars($_GET['country']); ?>
  <?php $context = htmlspecialchars($_GET['context']); ?>

  <?php if (empty($country)):?>
    <table>
      <thead>
        <tr>
          <th>Country Name</th>
          <th>Continent</th>
          <th>Independence Year</th>
          <th>Head of State</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($results as $row): ?>
          <tr>
            <td><?= $row['name']?></td>
            <td><?= $row['continent']?></td>
            <td><?= $row['independence_year']?></td>
            <td><?= $row['head_of_state']?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <?php if (!empty($country)): ?>
    <?php if (empty($context)): ?>
      <table>
        <thead>
          <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($output as $row): ?>
            <tr>
              <td><?= $row['name']?></td>
              <td><?= $row['continent']?></td>
              <td><?= $row['independence_year']?></td>
              <td><?= $row['head_of_state']?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php if ($context = "cities"): ?>
      <table>
        <thead>
          <tr>
            <th>City Name</th>
            <th>District</th>
            <th>Population</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($cities as $row): ?>
            <tr>
              <td><?= $row['name']?></td>
              <td><?= $row['district']?></td>
              <td><?= $row['population']?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>