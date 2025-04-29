
<?php
/*
//Kutambahin
public static function Select_Driver_By_Id($username) {
    $conn = Database::getConnection();

    error_log("Fetching driver data for username: " . $username);
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE id = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $encryptedPassword = $row['password'];
        $encryptedIdNumber = $row['idNumber'];

        $decryptedIdNumber = Security::decrypt($encryptedIdNumber);
        if ($decryptedIdNumber === false) {
            $decryptedIdNumber = $encryptedIdNumber;
        }

        return new Driver(
            $row['id'],
            $row['fullName'],
            $row['email'],
            $encryptedPassword, // still storing encrypted
            (float)$row['phoneNumber'],
            $decryptedIdNumber,
            $row['licenceNumber'],
            $row['plateNumber'],
            $row['driverType']
        );
    } else {
        error_log("No driver found with username: " . $username);
        return null;
    }
}

}
*/
?>