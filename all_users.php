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
		<form method ="post">
			<p> Start with a letter: <input type="text" name="name"/>
			 and status is: 
			<select name="status">
				<option value="Active account">Active account</option>
				<option value="Waiting for account validation">Waiting for account validation</option>
			</select>
			<input type="submit" value="ok"/><p>
		</form>
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
			
			// FORMULAIRE
			
			if(isset($_POST["name"])) {
				$nameFilter = $_POST["name"]."%";
			} else {
				$nameFilter = "%";
			}
			if(isset($_POST["status"])) {
				$statusFilter = $_POST["status"];
			} else {
				$statusFilter = "%";
			}
			
			
			// REQUETE
			$stmt = $pdo->query('select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id
								where s.name LIKE("'.$statusFilter.'") AND username LIKE("'.$nameFilter.'")');
			
			
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