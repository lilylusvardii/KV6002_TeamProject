<meta name="viewport" content="width=device-width, initial-scale=1.0"><?php
		
ini_set("session.save_path", "/Documents/KV6002_TeamProject/sessionData");
session_start();		
		
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Logging in</title>
</head>
<body>
<main>
		<?php
	
		$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username']: null;
		$username = trim($username);
		$password = filter_has_var(INPUT_POST, 'password') ? $_POST['password']: null;
		$password = trim($password);
		
		if (empty($username) || empty($password)) { 
			echo "<p>please input a username and password. <a href = 'Login.html'>Try here</a></p>\n";
		}
		else {
			try { 
			
				unset($_SESSION['username']);
				unset($_SESSION['logged-in']);
				
				require_once("databaseConn.php");
				$dbConn = getConnection();
				
				$sql = "SELECT passwordHash 
				FROM nmc_users 
				WHERE username = :username";
				
				$stmt = $dbConn->prepare($sql);
				$stmt->execute(array(':username' => $username));
				
				$user = $stmt->fetchObject();
				if ($user) {
						if (password_verify($password, $user->passwordHash)) {
							echo "<p>logged in successfully!</p>";
							echo "<a href = 'listedRecords.php'>you can edit records here</a>\n";
							$_SESSION['logged-in'] = true; 
							$_SESSION['username'] = $username;
						}
						else { 
							echo "<p>the username or password is incorrect please <a href='logOnForm.html'>try again</a></p>\n";
						}
						
				
				}
				elseif($user != $username) {
					echo "<p>the username or password is incorrect please <a href='logOnForm.html'>try again</a></p>\n";
				}
						
			}catch (Exception $e) { 
				echo "record not found: " . $e->getMessage();}
		}
		?>
		</main>
	</body>
</html>
