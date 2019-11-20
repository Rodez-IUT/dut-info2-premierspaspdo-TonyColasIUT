<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>PHP</title>
	  
		<style>
			table {
				border-collapse: collapse;
				width: 100%;
			}
			th, td {
				padding: 8px;
				text-align: left;
				border-bottom: 1px solid #ddd;
			}
		</style>
		
	</head>
	<body>
	
		<?php 
			// CONNEXION
			$host = 'localhost';
			$db   = 'my_activities';
			$user = 'root';
			$pass = 'root';
			$charset = 'utf8';
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			try {
				$pdo = new PDO($dsn, $user, $pass, $options);
			} catch (PDOException $e) {
				 throw new PDOException($e->getMessage(), (int)$e->getCode());
			}
			// CONNEXION TERMINE
			
			// REQUETE
			$stmt = $pdo->query('select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id
								where s.name = "Active account" AND username LIKE("e%")');
			// TRAITEMENT
			$i=0;
			echo "<table>";
			while ($row = $stmt->fetch())
			{

				echo "<tr>";
				echo "<td>".$row['user_id']."</td>";
				echo "<td>".$row['username']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['status']."</td>";
				echo "</tr>";
			}
			echo "<table>";
		?>
	</body>
</html>